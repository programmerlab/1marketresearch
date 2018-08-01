<?php

namespace Modules\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class CoupanRequest  extends Request {

    /**
     * The metric validation rules.
     *
     * @return array    
     */
    public function rules() { 
            switch ( $this->method() ) {
                case 'GET':
                case 'DELETE': {
                        return [ ];
                    }
                case 'POST': {
                        return [
                            'coupan_code' => 'required', 
                             'start_date'  => "required" , 
                             'end_date'    => "required" , 
                             'fix_discount'    => "required" ,
                             'percentage_discount'    => "required" 
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    if ( $coupan = $this->coupan) {

                        return [
                            'coupan_code' => 'required', 
                             'start_date'  => "required" , 
                             'end_date'    => "required" , 
                             'fix_discount'    => "required" ,
                             'percentage_discount'    => "required"  
                        ];
                    }
                }
                default:break;
            }
        //}
    }

    /**
     * The
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

}
