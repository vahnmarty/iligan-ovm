<div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
    </div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <div class="py-4 space-y-8">
            <div>
                <h3 class="text-3xl font-bold leading-6 text-red-600">MMDA</h3>
                <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-3">
                    <div
                        class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6"
                    >
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Total Users
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            31,897
                        </dd>
                    </div>
    
                    <div
                        class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6"
                    >
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Leaders
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            1501
                        </dd>
                    </div>
    
                    <div
                        class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6"
                    >
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Members
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            24,515
                        </dd>
                    </div>
                </dl>
            </div>
    
            <div>
                <h3 class="text-3xl font-bold leading-6 text-red-600">Mortuary</h3>
                <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-3">
                    <div
                        class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6"
                    >
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Total Members
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            71,897
                        </dd>
                    </div>
    
                    <div
                        class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6"
                    >
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Claim ({{ date("F, Y") }})
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            ₱58,511
                        </dd>
                    </div>
    
                    <div
                        class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6"
                    >
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Claim ({{ date("Y") }})
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            ₱761,451
                        </dd>
                    </div>
                </dl>
            </div>
    
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div>
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-3xl font-bold text-red-500">Barangay</h1>
                    </div>
                </div>
                <div class="flex flex-col mt-8">
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
                                            <th
                                                scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                Barangay
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Representative
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Leaders
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Members
                                            </th>
                                            <th
                                                scope="col"
                                                class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                            >
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200"
                                    >
                                        @foreach(Helpers::get_barangays() as $brgy)
                                        <tr>
                                            <td
                                                class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6"
                                            >
                                                {{ $brgy->name }}
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap"
                                            >
                                                Vahn Marty
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap"
                                            >
                                                {{ rand(200, 500) }}
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap"
                                            >
                                                {{ rand(1500, 5000) }}
                                            </td>
                                            <td
                                                class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6"
                                            >
                                                <a
                                                    href="#"
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                    >Edit<span class="sr-only"
                                                        >, Lindsay Walton</span
                                                    ></a
                                                >
                                            </td>
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
