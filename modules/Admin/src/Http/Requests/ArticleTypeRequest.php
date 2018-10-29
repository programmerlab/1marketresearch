<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleTypeRequest extends FormRequest
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
                            'article_type'          => 'required|unique:article_type,article_type',
                            'resolution_department' => 'required',
                        ];
                    }
                case 'PUT':
                case 'PATCH': {

                        return [
                            'article_type'          => 'required',
                            'resolution_department' => 'required',

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
