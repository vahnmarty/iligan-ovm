<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    const CONTRIBUTION = 'contribution';

    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function credit($amount, Transaction $transaction)
    {
        $prev_balance = $this->current_balance;
        $new_balance = $prev_balance + $amount;

        $this->transactions()->create([
            'type' => 'credit',
            'amount' => $amount,
            'previous_balance' => $prev_balance,
            'new_balance' => $new_balance,
            'source' => $transaction->control_number
        ]);

        $this->setBalance($new_balance);
    }

    public function debit($amount, Transaction $transaction)
    {
        $prev_balance = $this->current_balance;
        $new_balance = $prev_balance - $amount;
        
        $this->transactions()->create([
            'type' => 'debit',
            'amount' => $amount,
            'previous_balance' => $prev_balance,
            'new_balance' => $new_balance,
            'source' => $transaction->control_number
        ]);

        $this->setBalance($new_balance);
    }

    public function setBalance($new_balance)
    {
        $prev_balance = $this->current_balance;

        $this->update([
            'previous_balance' => $prev_balance,
            'current_balance' => $new_balance
        ]);
    }
}
