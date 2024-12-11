<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FoodGroupRequest extends FormRequest
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
        $idg = $this->route('food_group');
        return [
            'group' => [
                'required',
                'string',
                'max:255',
                'min:5',
                'regex:/^[a-zA-Z\s]+$/u',
                Rule::unique('food_groups', 'group')->ignore($idg), 
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
