<div class="min-h-screen text-white bg-blue-500 h-100">
    <header class="flex items-end justify-between px-8 py-10 pb-8 mb-8 border-b border-white">
        <h1 class="text-4xl font-bold">OVM | Logistics</h1>
        <p class="text-2xl font-bold">{{ now()->format('F d, Y h:i a') }}</p>
    </header>

    <div class="px-8 mt-8 space-y-16">
        <section>
            <h3 class="text-2xl font-bold">TODAY</h3>
            <div class="grid grid-cols-4 gap-16 mt-4">
                @foreach($today_widgets as $item)
                <div class="flex px-4 py-6 text-gray-900 bg-white rounded-md shadow-sm">
                    @svg($item->material->ui_icon, ['class' => 'w-12 h-12 text-gray-500'])
                    <div class="ml-4">
                        <h4 class="text-lg font-bold">{{ $item->material->name }}</h4>
                        <p>x{{ $item->quantity }}</p>
                        <p class="mt-4"><strong>Reference:</strong> {{ $item->parent->control_number }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <section>
            <h3 class="text-2xl font-bold">TOMORROW</h3>
            <div class="grid grid-cols-4 gap-16 mt-4">
                @foreach($today_widgets as $item)
                <div class="flex px-4 py-6 text-gray-900 bg-white rounded-md shadow-sm">
                    @svg($item->material->ui_icon, ['class' => 'w-12 h-12 text-gray-500'])
                    <div class="ml-4">
                        <h4 class="text-lg font-bold">{{ $item->material->name }}</h4>
                        <p>x{{ $item->quantity }}</p>
                        <p class="mt-4"><strong>Reference:</strong> {{ $item->parent->control_number }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>