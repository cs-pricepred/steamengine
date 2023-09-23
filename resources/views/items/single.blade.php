<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-xl">
            {{ $item->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col gap-y-10">

                <div id="salegraph" class=""></div>

                <div id="salelist" class="">
                    <div class="grid grid-cols-3 px-2 py-4 font-mono font-bold border-b border-white">
                            <p>Date</p>
                            <p class="text-center">Value</p>
                            <p class="text-right">Volume</p>
                    </div>
                    @foreach ($saleHistory as $s)
                        <div class="grid grid-cols-3 px-2 py-4 even:bg-neutral-800 font-mono">
                            <p>{{$s->time}}</p>
                            <p class="text-center">{{$s->price}}</p>
                            <p class="text-right">{{$s->volume}}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

@push('scripts')
<script>
let saleHistory = {!! json_encode($saleHistory) !!}
</script>
@vite('resources/js/components/SaleHistoryGraph.js')
@endpush
</x-app-layout>
