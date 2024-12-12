<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FoodTypeRequest extends FormRequest
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
        $idt = $this->route('food_type');
        return [
            'type' => [
                'required',
                'string',
                'max:255',
                'min:5',
                'regex:/^[a-zA-Z\s]+$/u',
                Rule::unique('food_types', 'type')->ignore($idt), 
            ],
            'status' => [
                'nullable',
                'boolean'
            ],
            'description' => [
                'required',
                'min:10',
                'max:255',
                'string',
            ],
        ];
    }
}
