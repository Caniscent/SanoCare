@extends('layouts.app')

@section('title')
    Check
@endsection

@section('content')
<section class="bg-white dark:bg-blue-400">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Check Tubuh Ideal</h1>

        @if ($data->isEmpty())
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">Anda belum melakukan pengecekan. Ayo cek sekarang!</p>
            <div class="flex justify-center">
                <a href="{{ route('check.create') }}" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Check</a>
            </div>
        @else
            <div class="w-full flex justify-center gap-5 flex-wrap">
                @foreach ($data as $item)
                <div class="w-80 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="px-5 pb-5">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $item['height_check'] }} cm</h5>
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $item['weight_check'] }} kg</h5>

                        @if ($item->status == 'ideal')
                            <p class="text-green-600 dark:text-green-400">Tubuh Anda ideal.</p>
                            <p class="text-gray-500 dark:text-gray-400">{{ $item->tips }}</p>
                        @else
                            <p class="text-red-600 dark:text-red-400">Tubuh Anda belum ideal.</p>
                            <p class="text-gray-500 dark:text-gray-400">{{ $item->tips }}</p>
                        @endif

                        <a href="{{ route('check.edit', $item->id) }}" class="mt-4 text-blue-700 hover:underline">Ubah data</a>
                        |
                        <form action="{{ route('check.destroy', $item['id']) }}" method="post" class="inline">
                            @method('delete')
                            @csrf
                            <button type="submit"
                                class="mt-4 text-red-700 hover:underline">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

<div class="bg-gray-50 dark:bg-gray-800 py-8">
    <div class="mx-auto max-w-screen-lg px-4">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-900 dark:text-white">Tips untuk Anda</h2>

        <!-- Loop through the data for tips -->
        @foreach ($data as $item)
        @if ($item->status == 'ideal')
        <div class="mb-6">
            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                @foreach ($item->news as $news)
                <li>
                    <a href="{{ $news->link }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                            {{ $news->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @else
            <div class="mb-6">
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                    @foreach ($item->news as $news)
                    <li>
                        <a href="{{ $news->link }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                            {{ $news->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            @endforeach
        </div>
        @endif
    </div>
@endsection
