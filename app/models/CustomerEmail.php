<?php

class CustomerEmail extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_email';
	
	protected $fillable = array('email', 'customer_code');
	
	public function customer(){
		return $this->belongsTo('Customer','customer_code');
	}
	
	public static $rules = array(
            'email' => array('required', 'unique:email'),
            'customer_code' => array('required')
            );
	
	public $error;
	
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