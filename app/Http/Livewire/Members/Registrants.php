<?php

namespace App\Http\Livewire\Members;

use Livewire\Component;
use App\Models\User;

class Registrants extends Component
{
    public $members;

    public function render()
    {
        return view('livewire.members.registrants')->layout('layouts.admin');
    }

    public function mount()
    {
        $this->getMembers();
    }

    public function getMembers()
    {
        $this->members = User::registrants()->get();
    }
}
