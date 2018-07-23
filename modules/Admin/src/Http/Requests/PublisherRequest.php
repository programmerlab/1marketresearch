<?php

namespace Modules\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class PublisherRequest  extends Request {

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
                            'publisher' => 'required', 
                            'company'=> 'required'

                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    if ( $result = $this->result) {

                        return [
                            'publisher' => 'required', 
                            'company'=> 'required'
                            
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
