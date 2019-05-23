<?php

namespace App\Http\Requests\Admin\Employees;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request('employee');
        return [
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email|min:2|max:70|unique:employees,email,'.$id,
            'phone' => 'nullable|string|min:9|max:12|unique:employees,phone,'.$id,
        ];
    }
}
