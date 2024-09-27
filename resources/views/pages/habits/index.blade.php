@extends('layouts.app')

@section('title', 'Kebiasaan')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">Kebiasaan Anda</h1>
            <a href="{{ route('habits.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Tambah Kebiasaan</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($habits as $habit)
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white dark:bg-gray-800">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2 text-gray-900 dark:text-white">{{ $habit->name }}</div>
                    <p class="text-gray-700 dark:text-gray-300 text-base">
                        {{ $habit->description }}
                    </p>
                </div>
                <div class="px-6 py-4 flex justify-between">
                    <a href="{{ route('habits.edit', $habit->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                    <form action="{{ route('habits.destroy', $habit->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        @if ($habits->isEmpty())
        <div class="mt-8 text-center">
            <p class="text-lg text-gray-500 dark:text-gray-400">Anda belum memiliki kebiasaan. Silakan tambahkan kebiasaan baru.</p>
        </div>
        @endif
    </div>
</section>
@endsection
