<?php

namespace App\Http\Requests\AdminRequest;

use App\Enums\TypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class DiscountRequest extends FormRequest
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
        if ($this->route()->discountModel) {
            return [
                'name' => 'required|unique:discounts,name,' . $this->route()->discountModel->id,
                'slug' => 'required',
                'type' => ['required', new EnumValue(TypeEnum::class, false)],
                'value' => 'required|numeric',
                'activated' => 'required'
            ];
        }
        return [
            'name' => 'required|unique:discounts,name',
            'slug' => 'required',
            'type' => ['required', new EnumValue(TypeEnum::class, false)],
            'value' => 'required|numeric',
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
}
