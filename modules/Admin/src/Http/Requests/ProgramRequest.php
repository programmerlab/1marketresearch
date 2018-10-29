<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramRequest extends FormRequest
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
                            'program_name' => 'required',
                            'start_date'   => 'required',
                            'end_date'     => 'required',
                        ];
                    }
                case 'PUT':
                case 'PATCH': {

                        return [
                            'program_name'  => 'required',
                            'start_date'    => 'required',
                            'end_date'      => 'required',
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
