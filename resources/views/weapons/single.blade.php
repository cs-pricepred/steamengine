<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $weapon->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/skins/create" method="get" class="flex flex-col items-start gap-4">
                        @csrf
                        <input type="hidden" name="weapon_id" value="{{$weapon->id}}">
                        <p class="font-bold text-lg">Add new Skin</p>
                        <label>Name
                            <input type="text" name="name" class="dark:bg-black">
                        </label>
                        <button type="submit">Submit</button>
                    </form>

                    <div class="mt-10">
                        <h3 class="font-semibold text-lg">Skins</h3>
                        @foreach ($skins as $s)
                            <div class="flex gap-2">
                                <a href="/skins/{{$s->id}}">{{$s->name}}</a>
                                <p>{{$s->wear}}</p>
                                <p>{{$s->rarity}}</p>
                                <p>{{$s->stattrak}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
