<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(RequisitionItem::class, 'requisition_id');
    }


}
