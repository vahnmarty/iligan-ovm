<?php

namespace App\Http\Livewire\Members;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Person;
use Livewire\Component;
use App\Models\Transaction;

class MemberDashboard extends Component
{
    public $widgets = [ ];

    public function render()
    {
        return view('livewire.members.member-dashboard')->layout('layouts.admin');
    }

    public function mount()
    {
        $this->getWidgets();

    }

    public function getWidgets()
    {
        $this->widgets['overall'] = [
            'total_members' => User::members()->count(),
            'total_registrants' => Person::count(),
            'collected' => Transaction::sum('total'),
        ];

        $last7days = now()->subDays(7)->format('Y-m-d');
        $this->widgets['last_7_days'] = [
            'total_members' => User::members()->whereDate('approved_at', '>=' , $last7days )->count(),
            'total_registrants' => Person::where('date_registered', '>=' , $last7days)->count(),
            'collected' => Transaction::whereDate('paid_at', '>=', $last7days)->sum('total'),
        ];

        $this_month = date('m');
        $this->widgets['this_month'] = [
            'total_members' => User::members()->whereMonth('approved_at', $this_month )->count(),
            'total_registrants' => Person::whereMonth('date_registered' , $this_month)->count(),
            'collected' => Transaction::whereMonth('paid_at', $this_month)->sum('total'),
        ];
    }
}
