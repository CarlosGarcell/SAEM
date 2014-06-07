<?php

class City extends Eloquent
{
	protected $table = 'cities';
	public $error;
	public $fillable = ['id', 'city', 'last_update', 'states_id'];

	public static $rules = 
	[
		'id' => 'required|unique',
		'city' => 'required',
		'last_update' => 'required',
		'states_id' => 'required|unique',
	];

	public function address()
	{
		return $this->hasMany('Address');
	}

	public function state()
	{
		return $this->belongsTo('State');
	}
}