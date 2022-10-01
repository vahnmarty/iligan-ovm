<?php

namespace App\Models;

use Str;
use Spatie\ModelStatus\HasStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;
    use HasStatuses;
    

    protected $guarded = [];
    

    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->uuid)) {
                $user->uuid = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullName()
    {
        return strtoupper($this->last_name . ', ' . $this->first_name);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function generateVirtualId($id)
    {
        $year = date('Y');
        $seq = sprintf("%'.05d", $id);

        return $year . '-' . $seq;
    }

    
}
