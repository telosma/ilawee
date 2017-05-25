<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class CreateDocRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'notation' => 'required',
            'type' => 'required|exists:doc_types,id',
            'limit' => 'required',
            'field' => 'required',
            'publishDate' => 'required|date_format:Y-m-d',
            'startDate' => 'required|date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d',
            'effective' => 'required',
            'description' => 'required',
            'content' => 'required|min:200',
            'docFile' => 'required'
        ];
    }

    public function all()
    {
        $attributes = parent::all();
        $attributes['notation'] = trim($attributes['notation']);
        $attributes['limit'] = trim($attributes['limit']);
        $attributes['field'] = ucfirst(trim($attributes['field']));
        $description['description'] = trim($attributes['description']);

        return $attributes;
    }
}
