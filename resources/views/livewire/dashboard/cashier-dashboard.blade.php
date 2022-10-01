<div>
    <div class="px-4 sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">
            <span>Collection</span>
            <small class="text-sm font-medium text-gray-700">Last 7 days</small>
        </h1>
    </div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <div class="py-4 space-y-8">
            <div>
                <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-3">
                    <div
                        class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6"
                    >
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Total Collected Amount
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ number_format($widgets['total_amount'],2) }}
                        </dd>
                    </div>
    
                    <div
                        class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6"
                    >
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Total Receipt
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ number_format($widgets['total_items'],0) }}
                        </dd>
                    </div>
                </dl>
            </div>
    
        </div>
    </div>
</div>