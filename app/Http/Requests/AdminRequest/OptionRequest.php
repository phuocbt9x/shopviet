<?php

namespace App\Http\Requests\AdminRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class OptionRequest extends FormRequest
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
        if ($this->route()->optionModel) {
            return [
                'name' => 'required|unique:options,name,' . $this->route()->optionModel->id,
                'slug' => 'required',
                'activated' => 'required'
            ];
        }
        return [
            'name' => 'required|unique:options,name',
            'slug' => 'required',
            'activated' => 'required'
        ];
    }

   /**
    * If the activated field is missing, then add it to the request with a value of 0
    */
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
}
