<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
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
                            'title'             => 'required|unique:pages,title',
                            'page_content'      => 'required',
                            'images'            => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=800,min_height=350',
                        ];
                    }
                case 'PUT':
                case 'PATCH': {

                    return [
                        'title'             => 'required',
                        'page_content'      => 'required',
                        'images'            => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=800,min_height=350',
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
