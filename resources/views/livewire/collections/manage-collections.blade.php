<div>
    <div class="flex justify-between px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Collections</h1>
        <div>
            <x-button-link href="{{ url('admin/mortuary/collections/create') }}">
                Create
            </x-button-link>
            <x-button-link href="{{ url('admin/mortuary/collections/create?template=topup') }}">
                Top-up
            </x-button-link>
            <x-button-link href="{{ url('admin/mortuary/collections/create?template=registration') }}">
                New Registration
            </x-button-link>
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
                                        <x-table.th>Control</x-table.th>
                                        <x-table.th>Billed To</x-table.th>
                                        <x-table.th>Total</x-table.th>
                                        <x-table.th>Date Paid</x-table.th>
                                        <x-table.th>Action</x-table.th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    @foreach($data as $index => $item)
                                    <tr wire:key="coll-{{ $index }}">
                                        <x-table.td>{{ $item->id }}</x-table.td>
                                        <x-table.td>{{ $item->control_number }}</x-table.td>
                                        <x-table.td>{{ $item->customer ? $item->customer->getFullName() : '' }}</x-table.td>
                                        <x-table.td>{{ number_format($item->total, 2) }}</x-table.td>
                                        <x-table.td>{{ $item->paid_at->format('m/d h:i a') }}</x-table.td>
                                        <x-table.td>
                                            <x-button.button-primary size="sm">View</x-button.button-primary>
                                        </x-table.td>
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
