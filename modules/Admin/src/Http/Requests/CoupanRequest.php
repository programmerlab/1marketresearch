<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoupanRequest extends FormRequest
{
    /**
     * The metric validation rules.
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
                            'coupan_code'            => 'required',
                            'start_date'             => 'required',
                            'end_date'               => 'required',
                            'fix_discount'           => 'required',
                            'percentage_discount'    => 'required',
                        ];
                    }
                case 'PUT':
                case 'PATCH': {

                        return [
                            'coupan_code'            => 'required',
                            'start_date'             => 'required',
                            'end_date'               => 'required',
                            'fix_discount'           => 'required',
                            'percentage_discount'    => 'required',
                        ];

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
    public function authorize()
    {
        return true;
    }
}
