<?php

namespace App\Http\Requests\AdminRequest;

use App\Models\AdminModel\OptionModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ValueRequest extends FormRequest
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
        if ($this->route()->valueModel) {
            return [
                'value' => 'required|unique:option_values,value,' . $this->route()->valueModel->id,
                'slug' => 'required',
                'option_id' => 'required|exists:options,id',
                'activated' => 'required'
            ];
        }
        return [
            'value' => 'required|unique:option_values,value',
            'slug' => 'required',
            'option_id' => 'required|exists:options,id',
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
        if ($this->missing('option_id')) {
            $this->merge([
                'option_id' => $this->route()->optionModel->id
            ]);
        }
        $this->merge([
            'slug' => Str::slug($this->value),
        ]);
    }
}
