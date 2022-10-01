<div>
    <div class="flex justify-between px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Create Collection</h1>
        <div>
            <x-button-link href="{{ url('admin/mortuary/collections') }}"
                >Back</x-button-link
            >
        </div>
    </div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        
        <x-alert-errors/>

        @livewire('transactions.create-transaction', ['source' => 'collection'])
        
    </div>
</div>
