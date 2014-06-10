<?php

class Pvp extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pvp';
	
	protected $fillable = array('id', 'formula');
	
	public function categories(){
		return $this->belongsToMany('Category','pvp_has_categories', 'categories_id','pvp_id');
	}
	
	public static $rules = array(
            'id' => array('required', 'unique:id'),
            'formula' => array('required')
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