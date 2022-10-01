<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const REGISTRATION = 'registration_fee';

    protected $guarded = [];

    protected $dates = ['paid_at'];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function payments()
    {
        return $this->hasMany(TransactionPayment::class);
    }

    public function generateControlNumber()
    {
        $last = self::latest()->first();

        $id = $last ? ($last->id + 1) : 1;

        $date = date('Y-m');
        $seq = sprintf("%'.04d", $id);

        return 'SO-' . $date . '-' . $seq;
    }

    public function customer()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function scopePaid($query)
    {
        return $query->whereNotNull('paid_at');
    }
}
