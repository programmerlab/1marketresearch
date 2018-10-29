<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * The login validation rules.
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
                            'email'    => 'required|email',
                            'password' => 'required|min',
                        ];
                    }
                case 'PUT':
                case 'PATCH': {

                        return [
                            'email'    => 'required|email',
                            'password' => 'required',
                        ];

                }
                default:break;
            }
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
