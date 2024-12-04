@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'flex items-center px-4 py-2 rounded focus:outline-none bg-blue-600 focus:border-blue-700 transition duration-150 ease-in-out'
                : 'flex items-center px-4 py-2 rounded hover:bg-blue-600 hover:border-blue-300 focus:outline-none focus:border-blue-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
{{-- flex items-center px-4 py-2 rounded hover:bg-blue-600 --}}
