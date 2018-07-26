<?php

namespace Modules\Admin\Http\Requests;

use App\Http\Requests\Request; 
 

class ReportRequest  extends Request {

    /**
     * The product validation rules.
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
                            'title'        => 'required' ,  
                            'description'  => 'required', 
                            'photo'   => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
                            'signle_user_license' => 'required',
                            'multi_user_license' => 'required',
                            'corporate_user_license' => 'required',
                            'description' => 'required',
                            'table_of_contents' => 'required',
                            'number_of_pages' => 'required',
                            'report_id' => 'required',
                            'category' => 'required'
                        ];
                    }
                case 'PUT':
                case 'PATCH': {

                    if ( $reports = $this->reports ) {

                        return [
                            'title'      => 'required' ,  
                            'description'=> 'required', 
                            'photo'     => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
                            'signle_user_license' => 'required',
                            'multi_user_license' => 'required',
                            'corporate_user_license' => 'required',
                            'description' => 'required',
                            'table_of_contents' => 'required',
                            'number_of_pages' => 'required',
                            'report_id' => 'required',
                            'category' => 'required'
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
