<div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Members Dashboard</h1>
    </div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <div class="py-4 space-y-8">
            <div>
                <h4 class="font-bold">Overall</h4>
                <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-3">
                    <x-app.simple-widget title="Members" value="{{ $widgets['overall']['total_members'] }}" />
                    <x-app.simple-widget title="Registrants" value="{{ $widgets['overall']['total_registrants'] }}" />
                    <x-app.simple-widget title="Collected" value="{{ number_format($widgets['overall']['collected'], 2) }}" />
                </dl>
            </div>

            <div>
                <h4 class="font-bold">Last 7 days</h4>
                <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-3">
                    <x-app.simple-widget title="Members" value="{{ $widgets['last_7_days']['total_members'] }}" />
                    <x-app.simple-widget title="Registrants" value="{{ $widgets['last_7_days']['total_registrants'] }}" />
                    <x-app.simple-widget title="Collected" value="{{ number_format($widgets['last_7_days']['collected'], 2) }}" />
                </dl>
            </div>

            <div>
                <h4 class="font-bold">This Month</h4>
                <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-3">
                    <x-app.simple-widget title="Members" value="{{ $widgets['this_month']['total_members'] }}" />
                    <x-app.simple-widget title="Registrants" value="{{ $widgets['this_month']['total_registrants'] }}" />
                    <x-app.simple-widget title="Collected" value="{{ number_format($widgets['this_month']['collected'], 2) }}" />
                </dl>
            </div>
    
    
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div>
                <div class="flex flex-col mt-3">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                        >
                            <div
                                class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                            >
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <x-table.th>Barangay</x-table.th>
                                            <x-table.th>Members</x-table.th>
                                            <x-table.th>Registrants</x-table.th>
                                            <x-table.th>Collected</x-table.th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200"
                                    >
                                        @foreach(Helpers::get_barangays() as $brgy)
                                        <tr>
                                            <x-table.td>{{ $brgy->name }}</x-table.td>
                                            <x-table.td>{{ rand(0, 300) }}</x-table.td>
                                            <x-table.td>{{ rand(200, 500) }}</x-table.td>
                                            <x-table.td>
                                                <strong>{{ number_format( rand(200,500), 2) }}</strong>
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
        <!-- /End replace -->
    </div>
</div>
