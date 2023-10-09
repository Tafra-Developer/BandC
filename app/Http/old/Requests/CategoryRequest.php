<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Str;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name_ar' => 'required|string|max:255',
                        'name_en' => 'required|string|max:255',
                        'category_id' => 'nullable|exists:categories,id',
                        'has_child' => 'required|boolean',
                        'type' => 'required',
                        'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                    ];
                }
            case 'PUT': {
                    return [
                        'name_ar' => 'required|string|max:255',
                        'name_en' => 'required|string|max:255',
                        'category_id' => 'nullable|exists:categories,id',
                        'has_child' => 'required|boolean',
                        'type' => 'required',
                        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                    ];
                }
        }
    }
}
