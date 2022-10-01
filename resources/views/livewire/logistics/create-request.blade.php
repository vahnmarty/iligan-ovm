<div>

    @if(!$is_review)
    <div class="flex justify-between px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Create Request</h1>
        <div>
            <x-button-link href="{{ url('logistics/requests') }}"
                >Back</x-button-link
            >
        </div>
    </div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        
        <x-alert-errors/>
        
        <section class="p-4 mt-8 bg-white rounded-md">
            <form class="space-y-8 divide-y divide-gray-200" method="POST" wire:submit.prevent="save">
                <form class="" method="POST" wire:submit.prevent="save">

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
                                                    <x-table.th>#</x-table.th>
                                                    <x-table.th width="30%">Item Name</x-table.th>
                                                    <x-table.th>Stock</x-table.th>
                                                    <x-table.th>Quantity</x-table.th>
                                                    <x-table.th>From</x-table.th>
                                                    <x-table.th>To</x-table.th>
                                                    <x-table.th>
                                                        <span class="sr-only">Action</span>
                                                    </x-table.th>
                                                </tr>
                                            </thead>
                                            <tbody  class="bg-white divide-y divide-gray-200"
                                            >
                                                @foreach($items as $index => $item)
                                                    <tr x-data="{ 
                                                        item: $wire.entangle('items.{{ $index }}'),
                                                    }">
                                                        <x-table.td>{{ $index+1 }}</x-table.td>
                                                        <x-table.td>
                                                            <x-form.select wire:change="selectMaterial(`{{ $index}}`)"  wire:model="items.{{ $index }}.material_id" >
                                                                @foreach($materials as $materialItem)
                                                                <option value="{{ $materialItem->id }}">{{ $materialItem->name }}</option>
                                                                @endforeach
                                                            </x-form.select>
                                                        </x-table.td>
                                                        <x-table.td>
                                                            <x-form.input-text disabled class="bg-gray-100" type="number"  placeholder="0" wire:model="items.{{ $index }}.stock_available" />
                                                        </x-table.td>
                                                        <x-table.td>
                                                            <x-form.input-text type="number"  placeholder="0" wire:model="items.{{ $index }}.quantity"  />
                                                        </x-table.td>
                                                        <x-table.td>
                                                            <x-form.input-text type="date" placeholder="0" wire:model="items.{{ $index }}.date_start" />
                                                        </x-table.td>
                                                        <x-table.td>
                                                            <x-form.input-text type="date" placeholder="0" wire:model="items.{{ $index }}.date_end" />
                                                        </x-table.td>
                                                        <x-table.td>
                                                            <a href="#" wire:click.prevent="removeItem(`{{ $index }}`)">
                                                                <x-heroicon-s-trash  class="w-5 h-5 mr-2 text-red-700"/>
                                                            </a>
                                                        </x-table.td>
                                                    </tr>
                                                </template>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="pt-5 mt-8 border-t border-gray-300">
                    <div class="flex justify-between">
                        <div class="-ml-3">
                            <x-button.button-primary wire:click="addItem">
                                <x-heroicon-s-plus  class="w-5 h-5"/>
                                Add Item
                            </x-button.button-primary>
                        </div>
                        <div>

                        <x-button.button-primary type="button" wire:click="next">Next</x-button.button-primary>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
    @else
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <x-alert-errors/>
        <div class="max-w-lg mx-auto overflow-hidden">
            <section class="p-8 mt-8 bg-white border-dashed rounded-md">
                <header>
                    <h3 class="font-bold">Request Review</h3>
                </header>
                <div class="pt-4 mt-4 border-t border-dashed"></div>
                <div class="px-4">
                    @foreach(collect($items)->whereNotNull('material_id')->all() as $finalItem)
                    <div class="flex justify-between">
                        <p>{{ $finalItem['material_name'] }}</p>
                        <p>x{{ $finalItem['quantity'] }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="pt-4 mt-4 border-t border-dashed"></div>
                <div class="text-sm">
                    <p>Created By: {{ Auth::user()->name }}</p>
                    <p>Created At: {{ now()->format('F d, Y h:i a') }}</p>
                </div>
                
                <div class="relative mt-8">
                    <div class="pt-4 mt-4 border-t border-dashed"></div>
                    <div class="absolute left-0 right-0 flex justify-center px-6 -top-3">
                        <p class="font-bold bg-white">NOTHING FOLLOWS</p>
                    </div>
                </div>

                <div class="flex justify-center mt-8">
                    <x-button.button-secondary type="button" wire:click="back">Back</x-button.button-secondary>
                    <x-button.button-primary type="button" wire:click="confirm">CONFIRM</x-button.button-primary>
                </div>
            </section>
        </div>
    </div>
    @endif
</div>
