<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Weapons') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">

                    @foreach ($weapons as $w)
                        <div class="grid grid-cols-2 items-center odd:bg-gray-700 px-4 py-2">
                            <a href="/weapons/{{$w->id}}">{{$w->name}}</a>
                            <x-forms.weapon-select :w="$w" :types="$types"/>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
