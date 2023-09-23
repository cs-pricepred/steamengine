@props(['active'])

@php
$classes = 'text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out hover:-skew-x-12 hover:scale-y-125';
$classes .= ($active ?? false)
            ? ' border-b-2' : ' ';

@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
