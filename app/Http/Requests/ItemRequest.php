<?php

namespace App\Http\Requests;
//use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Requests\Request;

class ItemRequest extends Request
{
    public $iterator_number ;

    public $unlist = array('color3','size3','color2','size2');
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }

    protected function retrieve_col(){
        $obj = new Item();
        return $obj->current_columns();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = $this->request->all();        
        $counter = count($request['uom']);
        $cols = $this->retrieve_col();
        $return  = NULL;
        $unlist  = $this->unlist;
        foreach($cols as $key => $val){
            for($i = 0 ; $i < $counter ; $i++){                
                if(trim($request[$val][$i]) == "" && in_array($val , $unlist)){
                    continue;
                }
                $keygen = $val.".".$i;
                $rules = 'required|integer';
                switch ($val) {
                    case 'style_no':
                        # code...
                        $rules .= "|between:1,22";
                        break;                
                    case 'uom':
                        # code...
                        $rules .= "|between:1,55";
                        break;                
                    case 'prefix':
                        # code...
                        $rules .= "|between:1,555";
                        break;                
                    case 'suffix':
                        # code...
                        $rules .= "|between:1,55";
                        break; 
                    case 'height':
                        # code...
                        $rules .= "|between:1,55";
                        break; 
                    case 'width':
                        # code...
                        $rules .= "|between:1,11";
                        break; 
                    case 'length':
                        # code...
                        $rules .= "|between:1,11";
                        break; 
                    case 'weight':                    
                        $rules .= "|between:1,11";
                        break; 
                    case 'upc':                    
                        $rules .= "|between:1,5";
                        break; 
                    case 'size1':                    
                        $rules .= "|between:1,55";
                        break; 
                    case 'color1':                    
                        $rules .= "|between:1,55";
                        break; 
                    case 'size2':                    
                        $rules .= "|between:1,55";
                        break; 
                    case 'color2':                    
                        $rules .= "|between:1,55";
                        break; 
                    case 'size3':                    
                        $rules .= "|between:1,55";
                        break; 
                    case 'color3':                    
                        $rules .= "|between:1,55";
                        break; 
                    case 'carton':                    
                        $rules .= "|between:1,10";
                        break;
                    default:
                        break;
                }
                $return[$keygen] = $rules;
            }            
            
        }
        return array_merge($return , [
            //
            'container' => 'required',
            'receive' => 'required',
        ]);
    }

    public function set_iterator(int $number){
        return $this->iterator_number = $number;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $request = $this->request->all();
        $cols = $this->retrieve_col();        
        $counter = count($request['uom']);
        $return = NULL;
        foreach($cols as $key => $val){
            for($i = 0 ; $i < $counter ; $i++){                
                $new_i = $i+1;
                if(!in_array($val , $this->unlist)){
                    $return[$val.".".$i.".required"]    = 'The '.$val .' '.$new_i.' is required';
                }
                $return[$val.".".$i.".integer"]     = 'The '.$val .' '.$new_i.' must be an integer';
                $return[$val.".".$i.".between"]     = 'The '.$val .' '.$new_i.' must be between :min and :max.';
            }
        }
        
        return array_merge($return , [
            'container.required' => 'A container is required',
            'receive.required'  => 'A receiving is required',
        ]);
    }
}
