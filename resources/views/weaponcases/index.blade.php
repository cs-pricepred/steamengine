<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-xl text-stone-800 dark:text-stone-200 leading-tight">
            {{ __('Cases') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-2 gap-x-8 text-stone-800 dark:text-stone-200">

                    @foreach ($cases as $c)
                        <a href="/cases/{{$c->name}}" class="block border-b border-stone-300 dark:border-stone-700 px-4 py-4 hover:bg-stone-200 dark:hover:bg-stone-800 transition">{{$c->name}}</a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
