<?php

class Category extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';
	
	protected $fillable = array('id', 'category_description');
	
	public function categories(){
		return $this->belongsToMany('Pvp','pvp_has_categories','pvp_id', 'categories_id');
	}
	
	public static $rules = array(
            'id' => array('required', 'unique:id'),
            'formula' => array('required','max:100')
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