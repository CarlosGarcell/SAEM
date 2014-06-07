<?php

class Country extends Eloquent 
{
	protected $table = 'countries';
	public $error;

	protected $fillable = ['id', 'country', 'created_at'];

	public static $rules =
	[
		'id' => 'required|unique',
		'country' => 'required|unique',
		'created_at' => 'required'
	];

	public function states()
	{
		return $this->hasMany('State');
	}
}