<?php 
/**
* 
*/
class Credits extends Eloquent
{
	protected $table = 'credits';
	public $error;
    public $fillable = ['id','creation_date', 'amount', 'taxes', 'operators_idOperator', 'customer_code', 'document_types_documentid1'];
    public static $rules = array(
        'id' => array('required', 'unique:credits'),
        'creation_date' => array('required'),
        'amount' => array('required'),
        'taxes' => array('required'),
        'operators_idOperator' => array('required','max:20'),
        'customer_code' => array('required','max:10'),
        'document_types_documentid1' => array('required','max:6'),
        );

	public function document_types()
    {
        return $this->belongsTo('Document_Types','document_types_documentid1');
    }

    public function operators()
    {
        return $this->belongsTo('Operators','operators_idOperator');
    }

    public function customer()
    {
        return $this->belongsTo('Customer','customer_code');
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