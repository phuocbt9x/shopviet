<?php

namespace App\Http\Requests\AdminRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
        if ($this->route()->categoryModel) {
            return [
                'name' => 'required|unique:categories,name,' . $this->route()->categoryModel->id,
                'slug' => 'required',
                'category_id' => 'nullable|exists:categories,id',
                'activated' => 'required'
            ];
        }
        return [
            'name' => 'required|unique:categories,name',
            'slug' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'activated' => 'required'
        ];
    }

    public function prepareForValidation()
    {
        if ($this->missing('activated')) {
            $this->merge([
                'activated' => 0
            ]);
        }
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }

    public function attributes()
    {
        return [
            'category_id' => 'category'
        ];
    }
}
