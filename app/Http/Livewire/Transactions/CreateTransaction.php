<?php

namespace App\Http\Livewire\Transactions;

use Auth;
use App\Models\User;
use App\Models\Person;
use App\Models\Wallet;
use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\InvoiceTemplate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateTransaction extends Component
{
    use LivewireAlert;
    
    public $search_option = 'virtual_id';
    public $search_keyword;
    public $search_person_results = [];

    public $person, $user;

    public $source;

    public $template = 'registration';

    public $items = [], $overall_total = 0;

    public $payment_mode = 'cash', $payment_reference, $payment_amount = 0;

    public $add_balance = false;

    protected $queryString = ['search_keyword', 'template'];

    protected $rules = [
        'items' => 'required',
        'payment_mode' => 'required',
        'payment_reference' => 'required',
        'payment_amount' => 'required',
        'person' => 'required'
    ];
    
    public function render()
    {
        return view('livewire.transactions.create-transaction')->layout('layouts.admin');
    }

    public function mount($source)
    {
        if($this->template)
        {
            $this->fetchTemplate($this->template);
        }

        if($this->search_keyword)
        {
            $person = Person::whereVirtualId($this->search_keyword)->first();

            $this->person = $person ?? null;
            $this->user = $this->person->user;
        }
    }

    public function search()
    {
        if($this->search_option == 'virtual_id')
        {
            $this->searchUsingVirtualId();  
        }
    }

    public function updatedSearchKeyword()
    {
        $this->search();
    }

    public function searchUsingVirtualId()
    {
        $this->search_person_results = Person::whereVirtualId($this->search_keyword)->get();
    }

    public function selectPerson($id)
    {
        $this->person = Person::find($id);
        $this->user = $this->person->user;
    }

    public function fetchTemplate($code)
    {
        $template = InvoiceTemplate::with('items.product')->whereCode($code)->firstOrFail();

        foreach($template->items as $item)
        {
            $this->items[] = [
                'product_id' => $item->product_id,
                'name' => $item->product->name,
                'price' => $item->product->getPrice(),
                'quantity' => 1,
                'total' => $item->product->getPrice()
            ];
        }

    }

    public function save()
    {
        $this->validate();
        
        $transaction = $this->createTransaction();

        $this->createTransactionItems($transaction);

        $this->createPayments($transaction);
        
        $this->resetExcept('template');


        $this->alert('success', 'Payment successful!');
    }

    private function createTransaction()
    {
        $transaction = new Transaction;
        $transaction->control_number = $transaction->generateControlNumber();
        $transaction->user_id = $this->person->user_id;
        $transaction->person_id = $this->person->id;
        $transaction->created_by = Auth::id();
        $transaction->total = $this->overall_total;
        $transaction->paid_at = now();
        $transaction->source = $this->source;
        $transaction->remarks = '';
        $transaction->save();

        return $transaction;
    }

    private function createTransactionItems(Transaction $transaction)
    {
        foreach($this->items as $item)
        {
            $product = Product::find($item['product_id']);

            $transaction->items()->create([
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['quantity'] * $item['price']
            ]);

            if($product->code == Transaction::REGISTRATION)
            {
                $this->user->setStatus(User::PAYMENT_ACCEPTED);
                $this->user->readyForReview();
            }

            if($product->code == Wallet::CONTRIBUTION)
            {
                $this->user->topup($item['total'], $transaction);
            }
            
        }
    }

    private function createPayments(Transaction $transaction)
    {
        $transaction->payments()->create([
            'mode' => $this->payment_mode,
            'amount' => $this->payment_amount,
            'reference' => $this->payment_reference
        ]);      
    }
}
