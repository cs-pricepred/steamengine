<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div id="salegraph"></div>

            </div>
        </div>
    </div>

<script>
const saleHistory = {!! json_encode($saleHistory) !!}
</script>
</x-app-layout>
