<?php
namespace App\Models;
class Vendor extends BaseModel{
	protected $fillable = [];

	protected $table = "vendors";

	public $timestamps = false;

	public function item(){
		return $this->hasMany('item');
	}
	
}