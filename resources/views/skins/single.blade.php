<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between text-stone-800 dark:text-stone-200 ">
            <h2 class="font-bold text-xl leading-tight">
                <a href="/weapons/{{$weapon->id}}">{{ $weapon->name }}</a> | {{ $skin->name }}
            </h2>
            <div class="flex gap-2">
                <p>{{$skin->wear}}</p>
                <p>{{$skin->rarity}}</p>
                <p>{{$skin->stattrak}}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col gap-y-10">

                <div id="salegraph" class="text-black dark:text-white"></div>

                <div id="salelist" class="text-black dark:text-white bg-white dark:bg-stone-800">
                    <div class="grid grid-cols-3 px-2 py-4 even:bg-stone-100 dark:even:bg-stone-700 font-mono font-bold">
                            <p>Date</p>
                            <p class="text-center">Value</p>
                            <p class="text-right">Volume</p>
                    </div>
                    @foreach ($saleHistory as $s)
                        <div class="grid grid-cols-3 px-2 py-4 even:bg-stone-100 dark:even:bg-stone-700 font-mono">
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
