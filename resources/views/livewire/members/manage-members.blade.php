<div>
    <div class="flex justify-between px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Members</h1>
        <div>
            <x-button-link href="{{ url('admin/members/create') }}"
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
                                        <x-table.th>Full Name</x-table.th>
                                        <x-table.th>Barangay</x-table.th>
                                        <x-table.th>Purok</x-table.th>
                                        <x-table.th>Action</x-table.th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    @foreach($members as $m => $user)
                                    <tr wire:key="member-{{ $user->uuid }}">
                                        <x-table.td>{{ $user->person->official_id }}</x-table.td>
                                        <x-table.td>{{ $user->person->getFullName() }}</x-table.td>
                                        <x-table.td>{{ $user->person->barangay->name }}</x-table.td>
                                        <x-table.td>{{ $user->person->purok }}</x-table.td>
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
