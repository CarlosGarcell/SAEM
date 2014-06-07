<?php

class Address extends Eloquent 
{

	protected $table = 'address';
	public $error;
	public $filable = ['street', 'zip_code', 'avenue', 'residence_name','description', 'cities_id'];

	public static $rules = [
		'street' => 'required',
		'zip_code' => 'required',
		'avenue' => 'required',
		'residence_name' => 'required',
		'description' => 'required',
		'city_idcity' => 'required',
	];

	//Establishes May-To-Many relationship with the Customer model
	public function customers()
	{
		return $this->belongsToMany('Customer', 'customer_has_address', 'customers_id', 'address_cities_id');
	}

	public function contacts()
	{
		return $this->belongsToMany('Contact', 'address_has_contacts', 'address_cities_id', 'contacts_id');
	}

	public function operators()
	{
		return $this->belongsToMany('Operator', 'operators_has_address', 'operators_id', 'address_cities_id');
	}

	public function cities()
	{
		return $this->belongsTo('City');
	}



}