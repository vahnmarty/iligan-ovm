<div>
    <div class="p-4 mt-8 bg-white rounded-md">
        <header class="flex items-center gap-4">
            <h4 class="font-bold text-gray-900">Billed To:</h4>

            
            <div x-data="{ isOpen: false }" class="relative">
                <div class="relative mt-1 rounded-md shadow-sm">
                    <input type="text" 
                        wire:model.lazy="search_keyword" 
                        wire:keydown.enter="search"  
                        @input="isOpen = true" 
                        @keydown.enter="isOpen = true";
                        class="block w-full border-gray-300 rounded-md pl-28 focus:ring-indigo-500 focus:border-indigo-500 pr-7 sm:text-sm" 
                    placeholder="Search by {{ $search_option }}">
                    <div class="absolute inset-y-0 left-0 flex items-center">
                        <select wire:model="search_option" class="h-full py-0 pl-2 text-white bg-indigo-700 border-transparent rounded-md rounded-r-none focus:ring-indigo-500 focus:border-indigo-500 pr-7 sm:text-sm">
                            <option value="virtual_id">Virtual ID</option>
                            <option value="name">Name</option>
                        </select>
                    </div>
                </div>
                <div x-show="isOpen" 
                    class="absolute z-30 bg-white border shadow-lg w-96">
                    <div class="divide-y">
                        <div class="px-2 py-3 text-sm" wire:loading wire:target="search()">Searching ...</div>
                        @forelse($search_person_results as $search_person)
                        <div @click="isOpen = false" wire:click="selectPerson('{{ $search_person->id }}')"  wire:key="person-{{ $search_person->id }}"
                            class="grid grid-cols-3 px-2 py-3 text-sm cursor-pointer hover:bg-indigo-100">
                            <p class="font-bold">{{ $search_person->virtual_id }}</p>
                            <p class="col-span-2">{{ $search_person->getFullName() }}</p>
                        </div>
                        @empty
                        <div class="px-2 py-3 text-sm">No results found</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </header>
        <div class="py-4 bg-white">
            @if($person)
            <div class="flex gap-8">
                <div class="w-24 h-24 bg-gray-200"></div>
                <div class="space-y-1">
                    <div class="flex">
                        <h5 class="text-xl font-bold">{{ $person->getFullName() }}</h5>

                        <x-button.button-link href="{{ url('member', $person->uuid) }}">
                            View 
                        </x-button.button-link>
                    </div>
                    
                    <p class="text-sm">
                        <strong>Barangay:</strong> <span>{{ $person->barangay->name }}</span>
                    </p>
                    <p class="text-sm">
                        <strong>Purok:</strong> <span>{{ $person->purok }}</span>
                    </p>
                    <p class="text-sm">
                        <strong>Status:</strong>
                        <x-label-status status="{{ $person->labelStatus() }}">
                            {{ $person->status }}
                        </x-label-status>
                    </p>
                </div>
            </div>
            @else
            <div>
                <div class="flex gap-8 animate-pulse">
                    <div class="w-24 h-24 bg-gray-200"></div>
                    <div class="space-y-1">
                        <div class="h-6 bg-gray-200 w-96"></div>
                        <div class="h-6 bg-gray-200 w-96"></div>
                        <div class="h-6 bg-gray-200 w-96"></div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>


    @if($person)

    <div class="p-4 mt-8 bg-white rounded-md">
        <form class="" method="POST" wire:submit.prevent="save">

            <h1 class="font-bold">INVOICE</h1>

            <div class="pt-2 mt-3 border-t">
                <div class="flex flex-col">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full align-middle md:px-6 lg:px-6"
                        >
                            <div
                                class="px-2 py-2 pt-0 overflow-hidden bg-white"
                            >
                                <table
                                    class="min-w-full divide-y divide-gray-300"
                                >
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <x-table.th width="40%">Item Name</x-table.th>
                                            <x-table.th>Quantity</x-table.th>
                                            <x-table.th>Rate</x-table.th>
                                            <x-table.th>Total</x-table.th>
                                            <x-table.th>Action</x-table.th>
                                        </tr>
                                    </thead>
                                    <tbody x-data="{ 
                                            items: @entangle('items').defer,
                                            overall_total: @entangle('overall_total').defer,
                                            calculateTotal(){
                                                this.overall_total = 0;
                                                    
                                                this.items.forEach( (item) => {
                                                    this.overall_total += item['total'];
                                                });
                                            },
                                            refreshMe(){
                                                setInterval(()=>{
                                                    this.calculateTotal();
                                                }, 500);
                                            }
                                        }"
                                        class="bg-white divide-y divide-gray-200"
                                    >
                                        <template x-for="(item,index) in items" :key="index">
                                            <tr x-effect="item['total'] = item['quantity'] * item['price']">
                                                <x-table.td>
                                                    <x-form.input-text  x-model="item['name']"  />
                                                </x-table.td>
                                                <x-table.td>
                                                    <x-form.input-text type="number" @input="calculateTotal()" @click="$el.select()" @focus="$el.select()" placeholder="0" x-model="item['quantity']"  />
                                                </x-table.td>
                                                <x-table.td>
                                                    <x-form.input-text type="number" @input="calculateTotal()" @click="$el.select()" @focus="$el.select()" placeholder="0.00" x-model="item['price']"  />
                                                </x-table.td>
                                                <x-table.td>
                                                    <x-form.input-text type="number" @change="calculateTotal()" placeholder="0.00" x-model="item['total']" disabled :disabled="true" />
                                                </x-table.td>
                                                <x-table.td>
                                                    <x-button.button-secondary>
                                                        <x-heroicon-s-trash  class="w-5 h-5 mr-2 text-red-700"/>
                                                        Remove
                                                    </x-button.button-secondary>
                                                </x-table.td>
                                            </tr>
                                        </template>
                                        <tr class="bg-red-100">
                                            <x-table.td>
                                                
                                            </x-table.td>
                                            <x-table.td>
                                            </x-table.td>
                                            <x-table.td>
                                                <p class="text-xl font-bold text-right">TOTAL:</p>
                                            </x-table.td>
                                            <x-table.td>
                                                <p class="text-xl font-bold text-center" x-text="overall_total.toFixed(2)"></p>
                                            </x-table.td>
                                            <x-table.td>
                                            </x-table.td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="p-4 mt-8 bg-white rounded-md">
        <h1 class="font-bold">PAYMENTS</h1>

        <div class="pt-2 mt-3 border-t">
            <div class="flex flex-col">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="inline-block min-w-full align-middle md:px-6 lg:px-6"
                    >
                        <div
                            class="px-2 py-2 pt-0 overflow-hidden bg-white"
                        >
                            <table
                                class="min-w-full divide-y divide-gray-300"
                            >
                                <thead class="bg-gray-200">
                                    <tr>
                                        <x-table.th>Mode</x-table.th>
                                        <x-table.th>Amount</x-table.th>
                                        <x-table.th>Reference</x-table.th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <x-table.td>
                                            <x-form.input-text value="{{ Str::upper($payment_mode) }}" :disabled="true" disabled  />
                                        </x-table.td>
                                        <x-table.td>
                                            <x-form.input-text type="number" wire:model.defer="payment_amount" />
                                        </x-table.td>
                                        <x-table.td>
                                            <x-form.input-text wire:model.defer="payment_reference" placeholder="Reference or OR#" />
                                        </x-table.td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-4 mt-8 bg-white rounded-md">
        <div>
            <div class="flex justify-end">
                <x-button.button-secondary type="button" wire:click="back">Back</x-button.button-secondary>
                <x-button.button-primary type="button" wire:click="save">Save</x-button.button-primary>
            </div>
        </div>
    </div>

    @endif
</div>
