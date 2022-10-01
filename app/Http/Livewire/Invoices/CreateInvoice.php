<?php

namespace App\Http\Livewire\Invoices;

use Auth;
use App\Models\Person;
use App\Models\Wallet;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\InvoiceTemplate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateInvoice extends Component
{

    use LivewireAlert;
    
    public $search_option = 'virtual_id';
    public $search_keyword;
    public $search_person_results = [];

    public $person;

    public $source;

    public $template;

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
        return view('livewire.invoices.create-invoice')->layout('layouts.admin');
    }

    public function mount($source)
    {
        if($this->template)
        {
            $this->fetchTemplate($this->template);
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
        $invoice = $this->createInvoice();

        $this->createInvoiceItems($invoice);

        $this->createPayments($invoice);

        $this->alert('success', 'Payment successful!');

        $this->resetExcept('template');
    }

    private function createInvoice()
    {
        $invoice = new Invoice;
        $invoice->number = $invoice->generateInvoiceNumber();
        $invoice->user_id = $this->person->user_id;
        $invoice->person_id = $this->person->id;
        $invoice->created_by = Auth::id();
        $invoice->total = $this->overall_total;
        $invoice->paid_at = now();
        $invoice->source = $this->source;
        $invoice->remarks = '';
        $invoice->save();

        return $invoice;
    }

    private function createInvoiceItems(Invoice $invoice)
    {
        foreach($this->items as $item)
        {
            $product = Product::find($item['product_id']);

            $invoice->items()->create([
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['quantity'] * $item['price']
            ]);

            if($product->code == Wallet::CONTRIBUTION)
            {
                $this->person->topup($item['total'], $invoice);
            }
            
        }
    }

    private function createPayments(Invoice $invoice)
    {
        $invoice->payments()->create([
            'mode' => $this->payment_mode,
            'amount' => $this->payment_amount,
            'reference' => $this->payment_reference
        ]);      
    }
}
