<?php

namespace App\Models\AdminModel;

use App\Enums\TypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountModel extends Model
{
    use HasFactory;
    protected $table = 'discounts';
    protected $fillable = ['name', 'slug', 'type', 'value', 'activated'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function status()
    {
        if ($this->activated == 1) {
            return '<span class="badge badge-success">Show</span>';
        }
        return '<span class="badge badge-danger">Hidden</span>';
    }

    public function getType()
    {
        if ($this->type == 1) {
            return "<span class='badge badge-primary'>" . TypeEnum::getKey($this->type) . "</span>";
        }
        return "<span class='badge badge-info'>" . TypeEnum::getKey($this->type) . "</span>";
    }
}
