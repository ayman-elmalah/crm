<?php

namespace App\Http\Requests\Admin\Companies;

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
        $id = request('company');
        return [
            'name' => 'required|string|min:2|max:50',
            'email' => 'nullable|email|min:2|max:70|unique:companies,email,'.$id,
            'logo' => 'nullable|image|max:10000|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
        ];
    }
}
