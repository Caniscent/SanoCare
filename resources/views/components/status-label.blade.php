@props(['value'])

<label {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-1 bg-white border 
rounded-md font-medium text-xs']) }}>
    {{ $value ?? $slot }}
</label>
