<?php 
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
* 
*/
class Debits_has_Credits extends Eloquent implements UserInterface, RemindableInterface 
{
	protected $table = 'debits_has_credits';
	public $error;
    public $fillable = ['debits_id','debits_document_types_documentid', 'creditsid', 'credits_document_types_documentid'];
    public static $rules = array(
            'debits_id' => array('required', 'unique:debits_has_credits'),
            'debits_document_types_documentid' => array('required','max:6'),
            'creditsid' => array('required'),
            'credits_document_types_documentid' => array('required','max:6')
            );

	public function debits()
    {
        return $this->belongsToMany('Debits','debits_id');
    }

    public function credits()
    {
        return $this->belongsToMany('Credits','credits_id');
    }

	public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getReminderEmail()
    {
        return $this->email;
    }
    public function isValid(){
        $validation = Validator::make($this->attributes, static::$rules);
        if($validation->passes())
        {
            return true;
        }
        $this->error = $validation->messages();
        return false;
    }
}
?>