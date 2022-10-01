<?php

namespace App\Http\Livewire\Collections;

use Livewire\Component;
use App\Models\Transaction;
use Auth;
use App\Models\User;

class ManageCollections extends Component
{
    public function render()
    {
        $data = $this->getCollections();
        return view('livewire.collections.manage-collections', compact('data'))
                ->layout('layouts.admin');
    }

    public function getCollections()
    {
        $isAdmin = Auth::user()->hasRole(User::ADMIN);

        if($isAdmin){
            $data = Transaction::whereSource('collection')->get();
        }else{
            $data = Transaction::whereSource('collection')->where('created_by', Auth::id())->get();
        }
        

        return $data;
    }
}
