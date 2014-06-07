<?php

class Contact extends Eloquent 
{
	protected $table = 'contacts';
	public $error;

	protected $fillable = ['id', 'name', 'description', 'customers_id'];

	public static $rules = 
	[
		'id' => 'unique|required',
		'name' => 'required',
		'description' => 'required',
		'customers_id' => 'required',
	];

	public function customers()
	{
		return $this->belongsToMany('Customer', 'contacts_has_customers', 'contacts_id', 'customers_id');
	}

	public function addresses()
	{
		return $this->belongsToMany('Address', 'address_has_contacts', 'address_cities_id', 'contacts_id');
	}

	public function contactsEmails()
	{
		return $this->hasMany('ContactEmail');
	}

	public function contactsPhones()
	{
		return $this->hasMany('ContactPhone');
	}


}