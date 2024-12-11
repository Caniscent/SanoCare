@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'py-2 flex font-semibold items-center rounded-lg px-4 w-[92%] mx-auto focus:outline-none bg-blue-600 focus:border-blue-700 transition duration-300 ease-in-out'
                : 'py-2 flex font-semibold items-center rounded-lg px-4 w-[92%] mx-auto hover:bg-blue-600 hover:border-blue-300 focus:outline-none focus:border-blue-300 transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

