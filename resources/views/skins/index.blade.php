<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-xl text-stone-800 dark:text-stone-200 leading-tight">
            {{ __('Skins') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-100 dark:bg-stone-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-stone-900 dark:text-stone-100">

                    @foreach ($skins as $s)
                    <p class="even:bg-stone-50 dark:even:bg-stone-700 px-4 py-2">
                        <a href="/skins/{{$s->id}}">{{$s->name}}</a>
                    </p>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
