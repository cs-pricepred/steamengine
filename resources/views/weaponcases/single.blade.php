<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-xl text-stone-800 dark:text-stone-200 leading-tight">
            {{ $case->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-stone-800 overflow-hidden shadow-sm sm:rounded-lg">

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
