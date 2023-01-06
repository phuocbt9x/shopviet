<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueModel extends Model
{
    use HasFactory;
    protected $table = 'option_values';
    protected $fillable = ['value', 'slug', 'option_id', 'activated'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getOption()
    {
        return $this->belongsTo(OptionModel::class, 'option_id');
    }

    public function status()
    {
        if ($this->activated == 1) {
            return '<span class="badge badge-success">Show</span>';
        }
        return '<span class="badge badge-danger">Hidden</span>';
    }
}
