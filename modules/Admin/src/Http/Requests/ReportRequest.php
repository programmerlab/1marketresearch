<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * The product validation rules.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {

                case 'GET':
                case 'DELETE': {
                        return [];
                    }
                case 'POST': {
                        return [
                            'title'                  => 'required',
                            'description'            => 'required',
                            'photo'                  => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
                            'signle_user_license'    => 'required',
                            'multi_user_license'     => 'required',
                            'corporate_user_license' => 'required',
                            'description'            => 'required',
                            'table_of_contents'      => 'required',
                            'number_of_pages'        => 'required',
                            'category'               => 'required',
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                        return [
                            'title'                  => 'required',
                            'description'            => 'required',
                            'photo'                  => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
                            'signle_user_license'    => 'required',
                            'multi_user_license'     => 'required',
                            'corporate_user_license' => 'required',
                            'description'            => 'required',
                            'table_of_contents'      => 'required',
                            'number_of_pages'        => 'required',
                            'category'               => 'required',
                        ];

                }
                default:break;
            }
        //}
    }
}
