<?php
namespace App\Models;

class Item extends BaseModel{

	protected $fillable = ['style_no','uom','prefix','suffix','height','length','weight','upc','size1','color1','carton','vendor_id',
    'width','measure','date','container','receive','color2','color3','size2','size3'];

	protected $table = "items";

	public $timestamps = false;

	public function vendor(){

		return $this->belongsTo('vendor');
	}

	public function current_columns(){
		$cols = $this->cols();
    	unset($cols[0]);unset($cols[16]);unset($cols[21]);unset($cols[20]);unset($cols[19]);unset($cols[18]);
    	$col = array_values($cols);
    	unset($cols);
    	foreach($col as $key => $val){

    		if($key >= 5){
    			if($key == 5){
    				$cols[$key] = $col[15];	
    			}else{
    				$cols[$key] = $col[$key - 1];
    			}    			
    		}else{
    			$cols[$key] = $val;
    		}
    	}
    	return $cols;
	}
	
}