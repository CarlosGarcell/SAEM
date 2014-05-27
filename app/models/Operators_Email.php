<?php 
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
* 
*/
class Operators_Email extends Eloquent implements UserInterface, RemindableInterface 
{
	protected $table = 'operators_email';
	public $error;
    public $fillable = ['email','operators_idOperator'];
    public static $rules = array(
            'email' => array('required','max:30', 'unique:operators_email'),
            'operators_idOperator' => array('required','max:20')
            );

	public function operators()
    {
        return $this->belongsTo('Operators','operators_idOperator');
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