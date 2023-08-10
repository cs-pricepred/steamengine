<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Weapons') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @foreach ($weapons as $w)
                        <div class="grid grid-cols-2">
                            <a href="/weapons/{{$w->id}}">{{$w->name}}</a>

                            <form action="/weapons/{{$w->id}}" method="POST">
                                @method('PUT')
                                @csrf
                                <select id="type" name="type">
                                    <option value="" {{ $w->type == null ? 'selected' : ''}}>none</option>
                                    @foreach ($types as $t)
                                        <option value="{{$t}}" {{ $t == $w->type ? 'selected': ''}}>{{$t}}</option>
                                    @endforeach
                                </select>
                                <button type="submit">send</button>
                            </form>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>