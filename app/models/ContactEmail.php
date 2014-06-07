<?php

class ContactEmail extends Eloquent 
{
	protected $table = 'contacts_email';
	public $error;

	protected $fillable = ['email', 'contacts_id'];

	public static $rules =
	[
		'email' => 'required|unique',
		'contacts_id' => 'required|unique'
	];

	public function email()
	{
		return $this->belongsTo('Contact');
	}
}