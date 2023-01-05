<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'category_id', 'activated'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function parentCategory()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id')->withDefault();
    }

    public function status()
    {
        if ($this->activated == 1) {
            return '<span class="badge badge-success">Show</span>';
        }
        return '<span class="badge badge-danger">Hidden</span>';
    }
}
