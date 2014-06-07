<?php

class ContactPhone extends Eloquent 
{
	protected $table = 'contacts_phone';
	public $error;

	protected $fillable = ['number', 'contacts_id'];

	public static $rules =
	[
		'number' => 'required|unique',
		'contacts_id' => 'required'
	];

	public function phone()
	{
		return $this->belongsTo('Contact');
	}
}