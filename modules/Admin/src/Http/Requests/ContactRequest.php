<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
                            'firstName' => 'required',
                            'email'     => 'required|email',
                            'phone'     => 'required',
                        ];
                    }
                case 'PUT':
                case 'PATCH': {

                        return [
                            'firstName' => 'required',
                            'email'     => 'required',
                            'phone'     => 'required',

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
