<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(InvoicePayment::class);
    }

    public function generateInvoiceNumber()
    {
        $last = self::latest()->first();

        $id = $last ? ($last->id + 1) : 1;

        $date = date('Y-m');
        $seq = sprintf("%'.04d", $id);

        return 'INV-' . $date . '-' . $seq;
    }
}
