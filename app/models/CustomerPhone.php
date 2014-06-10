<?php

class CustomerPhone extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_phone';
	
	protected $fillable = array('number', 'customers_id');
	
	public function customer(){
		return $this->belongsTo('Customer','customers_id');
	}
	
	public static $rules = array(
            'number' => array('required', 'unique:number'),
            'customers_id' => array('required')
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