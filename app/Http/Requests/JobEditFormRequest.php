<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobEditFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:10',
            'feature_image' => 'required|mimes:png,jpeg,jpg|max:2048',
            'description' => 'required',
            'roles' => 'required',
            'job_type' => 'required',
            'address' => 'required',
            'application_close_date' => 'required',
        ];
    }
}
