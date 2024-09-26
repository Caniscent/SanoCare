@extends('layouts.app')

@section('title')
    Manage Check
@endsection

@section('content')
<div class="">

    <h1
        class="text-center mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        Manajemen Sembako</h1>
    <hr class="my-5">
    <a href="{{ route('product.create') }}" type="button"
        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Tambah</a>
    <table id="search-table">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        No
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Nama
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Deskripsi
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Harga
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Gambar
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Aksi
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item['nama'] }}</td>
                    <td>{{ $item['description'] }}</td>
                    <td>
                        <img class="h-auto max-w-xs mx-auto" src="{{ asset('storage/product_images/'.$item['image']) }}"
                            alt="image description">
                    </td>
                    <td>Rp. {{ number_format($item['price']) }}</td>
                    <td>
                        <div class="w-full flex flex-wrap">
                            <a href="{{ route('product.edit', $item['id']) }}" type="button"
                                class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Edit</a>

                            <form action="{{ route('product.destroy', $item['id']) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <script>
        if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#search-table", {
                searchable: true,
                sortable: false
            });
        }
    </script>
@endpush
