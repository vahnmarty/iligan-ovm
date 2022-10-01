<?php

namespace App\Http\Livewire\Members;

use Livewire\Component;
use App\Models\User;

class ReviewBoard extends Component
{
    public $members;

    public function render()
    {
        return view('livewire.members.review-board')->layout('layouts.admin');
    }

    public function mount()
    {
        $this->getMembers();
    }

    public function getMembers()
    {
        $this->members = User::with('person')->role(User::USER_ROLE)->currentStatus(User::PENDING_APPROVAL)->whereNull('approved_at')->get();
    }
}
