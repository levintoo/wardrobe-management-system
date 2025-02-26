<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClothingItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'description' => ['nullable', 'max:2550'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'mimetypes:image/jpeg,image/png', 'max:2000'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
