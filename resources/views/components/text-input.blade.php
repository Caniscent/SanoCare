@props(['disabled' => false])

<input 
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge([
        'class' => 'form-control block w-full p-2 bg-white border 
                    border-gray-300 text-gray-900 text-sm rounded-lg 
                    shadow-sm focus:outline-none focus:ring-0 
                    focus:border-indigo-500 hover:border-indigo-400 
                    focus:bg-white hover:bg-white transition duration-200 
                    ease-in-out'
    ]) !!}
>



