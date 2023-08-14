@fragment('form')
    <form action="/weapons/{{$w->id}}" method="POST" hx-post="/weapons/{{$w->id}}" hx-swap="outerHTML">
        @method('PUT')
        @csrf
        <select id="type" name="type" class="dark:bg-black" hx-post="/weapons/{{$w->id}}" hx-target="closest form">
            <option value="" {{ $w->type == null ? 'selected' : ''}}>none</option>
            @foreach ($types as $t)
                <option value="{{$t}}" {{ $t == $w->type ? 'selected': ''}}>{{$t}}</option>
            @endforeach
        </select>
    </form>
@endfragment
