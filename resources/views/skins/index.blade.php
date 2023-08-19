<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-xl text-stone-800 dark:text-stone-200 leading-tight">
            {{ __('Skins') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-x-8 text-stone-800 dark:text-stone-200">

                @foreach ($skins as $s)
                    <a href="/skins/{{$s->id}}" class="block border-b border-stone-300 dark:border-stone-700 px-4 py-4 hover:bg-stone-200 dark:hover:bg-stone-800 transition">{{$s->name}}</a>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
