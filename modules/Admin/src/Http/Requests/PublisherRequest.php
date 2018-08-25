<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublisherRequest extends FormRequest
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
                            'publisher' => 'required',
                            'company'   => 'required',

                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                   // if ($result = $this->result) {
                        return [
                            'publisher' => 'required',
                            'company'   => 'required',

                        ];
                  //  }
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
