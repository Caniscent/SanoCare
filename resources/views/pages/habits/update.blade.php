@extends('layouts.app')

@section('title', 'Edit Kebiasaan')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">Edit Kebiasaan</h1>
        <form action="{{ route('habits.update', $habit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama Kebiasaan</label>
                <input type="text" id="name" name="name" value="{{ $habit->name }}" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan nama kebiasaan">
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Deskripsi</label>
                <textarea id="description" name="description" rows="4" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan deskripsi kebiasaan">{{ $habit->description }}</textarea>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Update</button>
        </form>
    </div>
</section>
@endsection
