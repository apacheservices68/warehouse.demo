<?php 
namespace App\Models;
use Illuminate\Support\Facades\Schema;
class BaseModel extends \Eloquent 
{
	public $timestamps = true;

	public function cols()
	{
		return Schema::getColumnListing($this->table);		
	}

	public function getTableColumns() {
		return Schema::getColumnListing($this->getTable());
        //return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}