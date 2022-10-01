<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Transaction;
use Auth;

class CashierDashboard extends Component
{
    public function render()
    {
        $widgets = $this->getCollections();
        return view('livewire.dashboard.cashier-dashboard', compact('widgets'));
    }

    public function getCollections()
    {
        $data = Transaction::where('created_by', Auth::id());

        $widgets = [
            'total_amount' => $data->sum('total'),
            'total_items' => $data->count(),
        ];

        return $widgets;
    }
}
