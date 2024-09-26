@extends('layouts.app')

@section('title')
    Check
@endsection

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Check Tubuh Ideal</h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">Here at
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, libero omnis repudiandae in cum esse, ea
            nesciunt consequatur nam voluptas earum doloremque ad obcaecati, modi commodi totam soluta. Magni, autem.
        </p>
        <div class="flex justify-center">
            <a href="{{ route('check.create') }}" type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Check</a>
        </div>

        <div class="w-full flex justify-center gap-5 flex-wrap">
            @foreach ($data as $item)
            <div class="w-80 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="px-5 pb-5">
                    <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $item['height_check'] }}</h5>
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $item['weight_check'] }}</h5>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
