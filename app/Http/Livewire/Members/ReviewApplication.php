<?php

namespace App\Http\Livewire\Members;

use App\Models\User;
use Livewire\Component;
use App\Models\Transaction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Auth;

class ReviewApplication extends Component
{
    use LivewireAlert;
    
    public $user;
    public $person;
    public $transaction;

    public $review_profile, $review_payment;

    public $review_ready, $is_done = false;

    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $this->review_ready = $this->review_profile && $this->review_payment;

        return view('livewire.members.review-application')->layout('layouts.admin');
    }

    public function mount($uuid)
    {
        $this->user = User::whereuuid($uuid)->first();
        $this->person = $this->user->person;

        $this->getTransactionRecord();
    }

    public function getTransactionRecord()
    {
        $this->transaction = Transaction::with('items')->whereUserId($this->user->id)->first();
    }

    public function approve()
    {
        $this->alert('question', 'Confirm Application?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, Approve Application',
            'timer' => null,
            'onConfirmed' => 'confirmed'
        ], [
            'position' => 'center'
        ]);
    }

    public function confirmed()
    {
        $user = $this->user;
        
        $user->approved_at = now();
        $user->approved_by = Auth::id();
        $user->active = true;
        $user->activated_at = now();
        $user->activated_by = Auth::id();
        $user->username = $user->generateUsername();
        $user->password = bcrypt($user->person->virtual_id);
        $user->save();

        $user->setStatus(User::REGISTRATION_COMPLETED);

        $user->person->update([
            'official_id' => 'TGH' . $user->person->virtual_id
        ]);

        // @dothis Notify SMS

        $this->is_done = true;
    }

}
