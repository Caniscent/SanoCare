@extends('layouts.app')

@section('title')
    Check Tubuh
@endsection

@section('content')
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 grid lg:grid-cols-2 gap-8 lg:gap-16">
        <div class="flex flex-col justify-center">
            <h1
                class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Tambah Data</h1>
            <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt assumenda iure, atque iste debitis
                perferendis. Unde aperiam cumque repellendus dignissimos nam! Commodi similique magnam non beatae
                assumenda molestiae, deserunt blanditiis.
            </p>
        </div>
        <div>
            <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Check Tubuh Ideal
                </h2>
                <form class="max-w-sm mx-auto" method="POST" action="{{ route('check.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <label for="height_check" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tinggi</label>
                        <input type="number" name="height_check" id="height_check" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>

                    <div class="mb-5">
                        <label for="weight_check" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berat</label>
                        <input type="number" name="weight_check" id="weight_check" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Check Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
