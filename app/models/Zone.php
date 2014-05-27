<?php 
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
* 
*/
class Zone extends Eloquent implements UserInterface, RemindableInterface 
{
	protected $table = 'zones';
	public $error;
    public $fillable = ['idZones','description'];
    public static $rules = array(
            'idZones' => array('required','max:10', 'unique:zone'),
            'description' => array('required','max:50')
            );

	public function operators(){
		return $this->hasMany('Operators', 'zones_idZones');
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