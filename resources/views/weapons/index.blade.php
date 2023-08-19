<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-xl text-stone-800 dark:text-stone-200 leading-tight">
            {{ __('Weapons') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-100 dark:bg-stone-800 overflow-hidden">
                <div class="text-stone-900 dark:text-stone-100">

                    @foreach ($weapons as $w)
                        <div class="grid grid-cols-2 items-center even:bg-stone-50 dark:even:bg-stone-700 px-4 py-2">
                            <a href="/weapons/{{$w->id}}">{{$w->name}}</a>
                            <x-forms.weapon-select :w="$w" :types="$types"/>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
