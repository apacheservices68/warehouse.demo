<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Datatables;

class ItemController extends Controller
{
    public $data = array();

    public function __construct(){
        $this->data['title'] = "Management Warehouses";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['vendor'] = Vendor::all();
        $this->data['body'] = 'public.home.index';
        return $this->output();
    }

    /*
    * 
    *
    *
    */

    protected function output($layout = NULL)
    {   
        if(is_null($layout)){
            $layout = 'public.layouts.default';
        }
        return view($layout , $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $obj = new Item();
        $cols = $obj->current_columns();
        $this->data['item'] = $cols;        
        $this->data['vendor'] = Vendor::lists('name','id');
        $measure  = array(0 => 'US-Imperal',1=>'CA-Imperal',2=>'GB-Imperal');
        $this->data['measure'] = $measure;        
        $this->data['body'] = 'public.home.create';
        return $this->output();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        //
        $request->except('_token');
        $item   = new Item($request->all());        
        $cols   = $item->current_columns();
        $alert  = $message = NULL;
        try{
            $alert = 'alert_success';
            $input  = Input::all();
            $length = count($input['style_no']);
            for($i =  0 ; $i < $length ; $i++){                        
                $item = (!isset($item)) ? new Item : $item;
                $item->vendor_id = $input['vendor'];
                $item->measure = $input['measure'];
                $item->date = date('Y-m-d H:i:s');
                $item->container = $input['container'];
                $item->receive = $input['receive'];
                foreach($cols as $key => $val){ 
                    $item->{$val} = $input[$val][$i];
                }   
                $item->save();
                unset($item);
            }
            $message = 'Adding item Successful.';
        }catch(Exception $e){
            $alert = 'alert_danger';
            $message  = $e->getMessage();
        }
        return redirect('/item/create')->with($alert,$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getItemData(){
        $obj = new Item ; 
        $cols   = $obj->current_columns();
        $item = Item::select(
        array('items.id','items.measure','vendors.name','items.date','items.container','items.receive')
        )->join('vendors','items.vendor_id','=','vendors.id')
        ;
        return Datatables::of($item)->make(true);
    }
}
