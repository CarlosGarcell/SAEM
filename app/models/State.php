<?php

class State extends Eloquent
{
	protected $table = 'states';
	public $error;
	public $fillable = ['id', 'state', 'last_updated', 'countries_id'];
	
	public $rules = 
	[
		'id' => 'required|unique',
		'state' => 'required',
		'last_updated' => 'required',
		'countries_id' => 'required|unique'
	];

	public function country()
	{
		return $this->belongsTo('Country');
	}

	public function cities()
	{
		return $this->hasMany('City');
	}
}