<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use HasUuid;

    protected $guarded = [];

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function getPrice()
    {
        $latest_price = $this->prices()->first();

        return $latest_price ? $latest_price->amount : 0;
    }
}
