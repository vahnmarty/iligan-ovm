<div>
    <div class="flex justify-between px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Requsitions</h1>
        <div>
            <x-button-link href="{{ url('logistics/requests/create') }}"
                >Create</x-button-link
            >
        </div>
        
    </div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <div class="py-4 space-y-8">
            <div class="flex flex-col">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                    >
                        <div
                            class="px-2 py-2 overflow-hidden bg-white shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                        >
                            <table
                                class="min-w-full divide-y divide-gray-300 table-datatable"
                            >
                                <thead class="bg-gray-50">
                                    <tr>
                                        <x-table.th>ID</x-table.th>
                                        <x-table.th>Item</x-table.th>
                                        <x-table.th>Active</x-table.th>
                                        <x-table.th>Available</x-table.th>
                                        <x-table.th>Onhand</x-table.th>
                                        <x-table.th>Action</x-table.th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    @foreach($data as $index => $item)
                                    <tr wire:key="material-{{ $item->id }}">
                                        <x-table.td>{{ $item->id }}</x-table.td>
                                        <x-table.td>
                                            <div class="flex gap-4">
                                                <div>
                                                    @svg($item->ui_icon, ['class' => 'w-8 h-8 text-gray-500'])
                                                </div>
                                                <div>
                                                    <h3 class="font-bold">{{ $item->name }}</h3>
                                                    <p>{{ $item->category->name }}</p>
                                                </div>
                                            </div>
                                        </x-table.td>
                                        <x-table.td>{{ $item->active ? 'Active' : 'Inactive' }}</x-table.td>
                                        <x-table.td>{{ $item->stock_available }}</x-table.td>
                                        <x-table.td>{{ $item->stock_onhand }}</x-table.td>
                                        <x-table.td></x-table.td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
