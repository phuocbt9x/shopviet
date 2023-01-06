<?php

namespace App\Http\Requests\AdminRequest;

use App\Enums\TypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CouponRequest extends FormRequest
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
        if ($this->route()->couponModel) {
            return [
                'name' => 'required|unique:coupons,name,' . $this->route()->couponModel->id,
                'slug' => 'required',
                'type' => ['required', new EnumValue(TypeEnum::class, false)],
                'value' => 'required|numeric',
                'code' => 'required',
                'time_start' => 'required',
                'time_end' => 'required|after:time_start',
                'stock' => 'required|numeric',
                'activated' => 'required'
            ];
        }
        return [
            'name' => 'required|unique:coupons,name',
            'slug' => 'required',
            'type' => ['required', new EnumValue(TypeEnum::class, false)],
            'value' => 'required|numeric',
            'code' => 'required',
            'time_start' => 'required',
            'time_end' => 'required|after:time_start',
            'stock' => 'required|numeric',
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
            'code' => Str::upper(Str::slug($this->name)),
            'time_start' => convertStrToTime($this->time_start),
            'time_end' => convertStrToTime($this->time_end)
        ]);
    }
}
