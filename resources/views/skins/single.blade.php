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
            <div class="bg-white dark:bg-stone-800 overflow-hidden shadow-sm sm:rounded-lg p-4">

                <div id="salegraph" class="text-black dark:text-white"></div>

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
