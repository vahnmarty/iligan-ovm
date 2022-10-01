<div>
    <div class="flex justify-between px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Review Application</h1>
        <div>
            <x-button-link href="{{ url('admin/members/pending-review') }}"
                >Back</x-button-link
            >
        </div>
    </div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        
        <x-alert-errors/>

        @if($user->isApproved())
        <div wire:poll>
            <div class="p-4 mt-8 border border-green-300 rounded-md bg-green-50">
                <div class="text-center">
                    <h3 class="text-xl">Successfully APPROVED <strong>{{ $person->getFullName() }}</strong></h3>

                    <div class="flex justify-center gap-8 mt-3">
                        <div >
                            <p>Your official id is:</p>
                        
                            <div class="flex justify-center mt-2">
                                <h2 class="px-16 py-4 text-xl font-bold tracking-wide bg-green-300 border-2 border-gray-700 border-dashed">
                                    {{ $person->official_id }}
                                </h2>
                            </div>
                        </div>
                        <div>
                            <p>Your Login access</p>
                        
                            <div class="flex mt-2 text-left">
                                <div class="px-8 py-4 bg-red-200 border-2 border-gray-700 border-dashed">
                                    <p>Username: <strong>{{ $user->username }}</strong></p>
                                    <p>Password: <strong>{{ $person->virtual_id }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="flex gap-8 p-8 mt-8 bg-white rounded-md" 
            x-data="{ checked: @entangle('review_profile') }"
            :class="checked ? 'bg-green-50  border-green-300 border' : '' ">
            <div>
                <input x-model="checked"
                type="checkbox" class="w-16 h-16 text-green-500 accent-green-500 focus:ring-green-500">
            </div>
            <div>
                <h3 class="text-lg font-bold">Personal Information</h3>

                <div class="w-32 mb-3 border border-gray-400"></div>
                
                <p class="text-sm"><strong class="mr-1">Full Name:</strong><span class="uppercase">{{ $person->getFullName() }}</span></p>
                <p class="text-sm"><strong class="mr-1">Barangay:</strong><span class="uppercase">{{ $person->barangay->name }}</span></p>
                <p class="text-sm"><strong class="mr-1">Purok:</strong><span class="uppercase">{{ $person->purok }}</span></p>
                <p class="text-sm"><strong class="mr-1">Phone:</strong><span class="uppercase">{{ $person->cellphone }}</span></p>

            </div>
        </div>

        <div class="flex gap-8 p-8 mt-8 bg-white rounded-md" 
            x-data="{ checked: @entangle('review_payment') }"
            :class="checked ? 'bg-green-50  border-green-300 border' : '' ">
            <div>
                <input x-model="checked"
                type="checkbox" class="w-16 h-16 text-green-500 accent-green-500 focus:ring-green-500">
            </div>
            <div class="w-full">
                <h3 class="font-bold">Payment</h3>

                <div class="w-32 mb-3 border border-gray-400"></div>

                @foreach($transaction->items as $item)
                <div class="grid w-1/2 grid-cols-3 gap-4 text-sm">
                    <div>
                        <x-heroicon-s-hashtag class="inline w-5 h-5 -mt-1 text-green-500" />
                        <span>{{ $transaction->control_number }}</span>
                    </div>
                    <div class="font-bold">
                        <span>{{ $item->product_name }}</span>
                    </div>

                    <div class="font-bold">
                        <span>{{ number_format($item->total,2) }}</span>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>

        <div class="mt-8 ">
            <div class="flex items-center justify-center gap-8">
                <div>
                    <button type="button" class="inline-flex items-center px-6 py-3 text-sm font-medium leading-4 text-red-700 bg-red-100 border border-transparent border-red-700 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Reject
                    </button>
                </div>
                
                <div>
                    <button wire:click="approve"
                         type="button" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500  {{ $review_ready ? 'opacity-100' : 'opacity-50 cursor-not-allowed' }} " {{ $review_ready ? '' : 'disabled' }} >
                        <x-heroicon-o-badge-check class="w-10 h-10 mr-3" />
                        Approve Application
                      </button>
                </div>
            </div>
        </div>
        @endif

        
    </div>
</div>
