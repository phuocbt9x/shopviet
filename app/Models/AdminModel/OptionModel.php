<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionModel extends Model
{
    use HasFactory;
    protected $table = 'options';
    protected $fillable = ['name', 'slug', 'activated'];

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
}
