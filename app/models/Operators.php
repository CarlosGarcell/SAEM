<?php 
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
* 
*/
class Operators extends Eloquent implements UserInterface, RemindableInterface 
{
	protected $table = 'operators';
	public $error;
    public $fillable = ['idOperator','name', 'comission', 'zones_idZones'];
    public static $rules = array(
            'idOperator' => array('required','max:20', 'unique:operators'),
            'name' => array('required','max:45'),
            'commission' => array('required'),
            'zones_idZones' => array('required','max:10')
            );

	public function zone()
    {
        return $this->belongsTo('Zone', 'zones_idZones');
    }

    public function operators_email(){
		return $this->hasMany('Operators_Email','operators_idOperator');
	}

    public function operators_phone()
    {
        return $this->hasMany('Operators_Phone', 'operators_idOperator');
    }

    public function debits() {
        return $this->hasMany('Debits', 'operators_idOperator');
    }

    public function credits() {
        return $this->hasMany('Credits', 'operators_idOperator');
    }

    public function operator_has_address()
    {
       return $this->hasMany('operator_has_address', 'operators_idOperator');
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