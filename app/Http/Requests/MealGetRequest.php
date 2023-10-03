<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator as Validator;

class MealGetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'lang' => 'required|max:10',
            'per_page' => 'max:10|gt:0',
            'with' => 'max:40',
            'page' => 'gt:0',
            'tags' => 'gt:0',
            'category' => 'gt:0',
            'diff_time' => 'gt:0',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
     throw new \Illuminate\Validation\ValidationException($validator, response()->json(['errors' => $validator->errors()], 422));
    }
}
