<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(Material::class, 'material_category_id');
    }
}
