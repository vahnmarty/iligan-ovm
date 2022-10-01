<?php

namespace App\Http\Livewire\Members;

use Livewire\Component;
use App\Models\User;

class ManageMembers extends Component
{
    public $members;

    public function render()
    {
        return view('livewire.members.manage-members')->layout('layouts.admin');
    }

    public function mount()
    {
        $this->getMembers();
    }

    public function getMembers()
    {
        $this->members = User::members()->get();
    }
}
