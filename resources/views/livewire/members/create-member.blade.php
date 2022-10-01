<div>
    <div class="flex justify-between px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Create Member</h1>
        <div>
            <x-button-link href="{{ url('admin/members/index') }}"
                >Back</x-button-link
            >
        </div>
    </div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        
        <x-alert-errors/>

        @if($is_success)
        <div>
            @if($person)
            <div class="p-4 mt-8 border border-green-300 rounded-md bg-green-50">
                <div class="text-center">
                    <h3 class="text-xl">Successfully added <strong>{{ $person->getFullName() }}</strong></h3>

                    <div class="mt-3">
                        <p>Your virtual id is:</p>
                    
                        <div class="flex justify-center mt-2">
                            <h2 class="px-16 py-4 text-3xl font-bold tracking-wide bg-green-300 border-2 border-gray-700 border-dashed">
                                {{ $person->virtual_id }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="py-4 bg-white">
                <div class="flex justify-center">
                    <x-button.button-secondary type="button" wire:click="exit">Exit</x-button.button-secondary>
                    <x-button.button-primary type="button" wire:click="createNew">Create New</x-button.button-primary>
                </div>
            </div>
        </div>
        @else
        <div class="p-4 mt-8 bg-white rounded-md">
            <form class="space-y-8 divide-y divide-gray-200" method="POST" wire:submit.prevent="save">
                @include('livewire.members._form')

                <div class="pt-5">
                    <div class="flex justify-end">
                        <x-button.button-secondary type="button" wire:click="back">Back</x-button.button-secondary>
                        <x-button.button-primary type="button" wire:click="next">Save</x-button.button-primary>
                    </div>
                </div>
            </form>
        </div>
        @endif
        
    </div>
</div>
