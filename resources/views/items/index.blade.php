<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-xl text-white">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-x-8">

                @foreach ($items as $i)
                    <a href="/items/{{$i->name}}" class="block border-b border-white px-4 py-4 hover:bg-neutral-800 transition">{{$i->name}}</a>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
