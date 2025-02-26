<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClothingItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'category_id' => ['required', 'exists:categories'],
            'size' => ['nullable'],
            'price' => ['nullable'],
            'image_path' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
