<?php

class Customer extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customers';
	
	protected $fillable = array('id', 'name', 'Rif', 'Nit', 'credit_limit', 'credit_days', 'registration_date', 'categories_id');
	//Categories
	public function categories(){
		return $this->belongsTo('Category', 'categories_id');
	}
	
	//Customer phone
    public function customerPhone(){
        return $this->hasMany('CustomerPhone', 'customers_id');
    }
	
	//Customer email
	public function customerEmail(){
        return $this->hasMany('CustomerEmail', 'customer_code');
    }
	
	//Credits
	public function credits(){
        return $this->hasMany('Credit', 'customers_id');
    }
	
	//Debits
	public function debits(){
        return $this->hasMany('Debit', 'customers_id');
    }
	
	//Address
	public function address(){
		return $this->belongsToMany('Address','address_has_customers','address_cities_id', 'customer_id');
	}
	
	//Contacts
	public function contacts(){
		return $this->belongsToMany('Contact','contact_has_customers','contacts_id', 'customer_id');
	}
	
	public static $rules = array(
            'id' => array('required', 'unique:id'),
            'name' => array('required','max:45'),
            'Rif' => array('required','max:13'),
			'Nit' => array('required','max:20'),
			'credit_limit' => array('required'),
			'credit_days' => array('required'),
			'categories_id' => array('required','max:15'),
            'registration_date' => array('required')
			
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