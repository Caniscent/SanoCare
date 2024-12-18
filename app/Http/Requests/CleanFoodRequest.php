<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CleanFoodRequest extends FormRequest
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
        $id = $this->route('clean_food');
        return [
            'food_name' => [
                'required',
                'string',
                'max:255',
                'min:5',
                'regex:/^[a-zA-Z\s]+$/u',
                Rule::unique('clean_foods', 'food_name')->ignore($id),
            ],
            'food_group_id' => 'required|exists:food_groups,id',
            'food_type_id' => 'required|exists:food_types,id',
            'calorie' => 'required|numeric|min:0|max:999.99',
            'protein' => 'required|numeric|min:0|max:99.99',
            'fats' => 'required|numeric|min:0|max:999.99',
            'carbs' => 'required|numeric|min:0|max:99.99',
            'fiber' => 'required|numeric|min:0|max:99.99',
        ];
    }
    public function messages(): array
    {
        return [
            'food_name.required' => 'Nama makanan wajib diisi.',
            'food_group_id.required' => 'Jenis makanan wajib dipilih.',
            'food_group_id.exists' => 'Jenis makanan yang dipilih tidak valid.',
            'food_type_id.required' => 'Tipe makanan wajib dipilih.',
            'food_type_id.exists' => 'Tipe makanan yang dipilih tidak valid.',
            'calorie.required' => 'Kalori wajib diisi.',
            'calorie.numeric' => 'Kalori harus berupa angka.',
            'calorie.max' => 'Kalori tidak boleh lebih dari 999.99.',
            'protein.required' => 'Protein wajib diisi.',
            'protein.numeric' => 'Protein harus berupa angka.',
            'protein.max' => 'Protein tidak boleh lebih dari 99.99.',
            'fats.required' => 'Lemak wajib diisi.',
            'fats.numeric' => 'Lemak harus berupa angka.',
            'fats.max' => 'Lemak tidak boleh lebih dari 999.99.',
            'carbs.required' => 'Karbohidrat wajib diisi.',
            'carbs.numeric' => 'Karbohidrat harus berupa angka.',
            'carbs.max' => 'Karbohidrat tidak boleh lebih dari 99.99.',
            'fiber.required' => 'Serat wajib diisi.',
            'fiber.numeric' => 'Serat harus berupa angka.',
            'fiber.max' => 'Serat tidak boleh lebih dari 99.99.',
        ];
    }
}
