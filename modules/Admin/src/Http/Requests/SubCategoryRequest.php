<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
                            'category_group_name'        => 'required',
                            'category_name'              => 'required',
                            'category_image'             => 'required|mimes:jpeg,bmp,png,gif',
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    if ($category = $this->category) {
                        return [
                            'category_group_name'        => 'required',
                            'category_name'              => 'required',
                            'category_image'             => 'required|mimes:jpeg,bmp,png,gif',
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
    public function authorize()
    {
        return true;
    }
}
