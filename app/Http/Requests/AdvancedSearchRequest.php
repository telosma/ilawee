<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvancedSearchRequest extends FormRequest
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
            'query' => 'required|min:2',
            'match' => 'required',
            'field' => 'required',
            'from' => 'date_format:Y-m-d',
            'to' => 'date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        return [
            'query.required' => 'Yêu cầu phải có từ khóa tìm kiếm',
            'query.min' => 'Độ dài từ khóa tối thiểu 2 ký tự',
            'match.required' => 'Chọn kiểu tìm kiếm',
            'field.required' => 'Chọn trường dữ liệu tìm kiếm',
            'from.date_format' => 'Ngày tháng nhập vào ở dạng năm-tháng-ngày (yyyy-mm-dd)',
            'to.date_format' => 'Ngày tháng nhập vào ở dạng năm-tháng-ngày (yyyy-mm-dd)'
        ];
    }
}
