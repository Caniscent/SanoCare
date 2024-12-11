<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $id = $this->route('article');
        return [
            'title' => [
                'required',
                'string',
                'max:100',
                'min:10',
                'regex:/^[a-zA-Z\s]+$/u',
                Rule::unique('articles', 'title')->ignore($id),
            ],
            'content' => 'required|min:50',
            'status' => 'required|in:draft,published,archived',
            'image' => [$this->method() === 'POST' ? 'required' : '', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
}
