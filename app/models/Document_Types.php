<?php 
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
* 
*/
class Document_Types extends Eloquent implements UserInterface, RemindableInterface 
{
	protected $table = 'document_types';
	public $error;
    public $fillable = ['documentid','type', 'description', 'percentage'];
    public static $rules = array(
            'documentid' => array('required','max:6', 'unique:document_types'),
            'type' => array('required','max:8'),
            'description' => array('required','max:100'),
            'percentage' => array('required')
            );

	public function debits()
    {
        return $this->hasMany('Debits','document_types_documentid');
    }

    public function credits()
    {
        return $this->hasMany('Credits','document_types_documentid1');
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