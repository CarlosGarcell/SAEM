<?php 
/**
* 
*/
class Debits extends Eloquent
{
	protected $table = 'debits';
	public $error;
    public $fillable = ['id','creation_date', 'due_date','amount','customer_code', 'operators_id', 'document_types_documentid'];
    public static $rules = array(
            'id' => array('required','unique:debits'),
            'creation_date' => array('required'),
            'due_date' => array('required'),
            'amount' => array('required'),
            'customer_code' => array('required', 'max:10'),
            'operators_idOperator' => array('required', 'max:20'),
            'document_types_documentid' => array('required', 'max:6')
            );

	public function operators()
    {
        return $this->belongsTo('Operators', 'operators_idOperator');
    }

    public function document_type()
    {
        return $this->belongsTo('Document_Type', 'document_types_documentid');
    }

    public function customers()
    {
        return $this->belongsTo('Customers','customer_code');
    }

    public function debits_has_credits()
    {
        return $this->hasMany('debits_has_credits', 'debits_id');
    }

    public function isValid()
    {
        $validation = Validator::make($this->attributes, static::$rules);
        if($validation->passes())
        {
            return true;
        }
        $this->error = $validation->messages();
        return false;
    }
}
?>