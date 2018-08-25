<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PressRequest extends FormRequest
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
                            'title'       => 'required',
                            'link'        => 'required',
                            'description' => 'required',

                        ];
                    }
                case 'PUT':
                case 'PATCH': {
               
                        return [
                            'title'       => 'required',
                            'link'        => 'required',
                            'description' => 'required',
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
