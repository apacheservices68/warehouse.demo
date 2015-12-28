<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Requests\ItemRequest;
use App\Models\Vendor;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;

class PrivateController extends Controller
{
	public $data = array();

    public function __construct(){

    }

    public function index(){
    	#$this->data['vendor'] = DB::table('vendors')->get();
    	$obj = new Item();
    	$cols = $obj->current_columns();
    	$this->data['item'] = $cols;
    	$this->data['vendor'] = Vendor::lists('name','id');
    	$measure  = array(0 => 'US-Imperal',1=>'CA-Imperal',2=>'GB-Imperal');
    	$this->data['measure'] = $measure;
    	$this->data['title'] = "Management Warehouses";
    	$this->data['body'] = 'public.home.index';
    	return $this->output();
    }

    public function create(){
    	$obj = new Item();
    	$cols = $obj->current_columns();
    	$this->data['item'] = $cols;
    	$new_obj = new ItemRequest;
    	return dd($new_obj->rules());
    	$this->data['vendor'] = Vendor::lists('name','id');
    	$measure  = array(0 => 'US-Imperal',1=>'CA-Imperal',2=>'GB-Imperal');
    	$this->data['measure'] = $measure;
    	$this->data['title'] = "Management Warehouses";
    	$this->data['body'] = 'public.home.index';
    	return $this->output();
    }

    public function store(ItemRequest $request){
    	$item = new Item($request->all());
    }

    public function edit(Item $item){

    }

    public function update(ItemRequest $request , Item $item){

    }

    public function delete(Item $item)
    {
        #return view('admin.photo.delete', compact('photo'));
    }

    public function destroy(Item $item)
    {
        $item->delete();
    }

    protected function output($layout = NULL)
	{	
		if(is_null($layout)){
			$layout = 'public.layouts.default';
		}
		return view($layout , $this->data);
	}
}
