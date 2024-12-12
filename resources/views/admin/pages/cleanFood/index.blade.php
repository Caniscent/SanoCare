@extends('admin.layouts.app')

@section('title', 'Makanan Pilihan')

@section('content')

<div class="overflow-x-auto mt-12">
    <h3 class="text-xl font-bold mb-4">Data Makanan</h3>
    <div class="flex justify-between items-center mb-4">
        <x-primary-button>
            <a href="{{route('admin.clean-food.create')}}">
                Tambah
            </a>
        </x-primary-button>
    </div>
    <table id="Table" class="table-auto w-full border-collapse border border-gray-200 text-sm sm:text-base">
        <thead>
            <tr class="bg-gray-150">
                <x-table.th>No</x-table.th>
                <x-table.th>Nama Makanan</x-table.th>
                <x-table.th>Kelompok Makanan</x-table.th>
                <x-table.th>Jenis Makanan</x-table.th>
                <x-table.th>Aksi</x-table.th>
            </tr>
        </thead>
        <x-table.tbody>
            @foreach ($food as $data)
            <x-table.tr>
                <x-table.td  class="text-left">{{ $loop->iteration }}</x-table.td>
                <x-table.td>{{ $data->food_name }}</x-table.td>
                <x-table.td>{{ $data->foodGroup->group }}</x-table.td>
                <x-table.td>{{ $data->foodType->type }}</x-table.td>
                <td class="py-3 px-6 text-center">
                    <div class="flex justify-center gap-2">
                        <x-edit-button class="w-15 h-8">
                            <a href="{{ route('admin.clean-food.edit', $data->id) }}">
                                Edit
                            </a>
                        </x-edit-button>
                        <x-edit-button class="w-15 h-8 bg-yellow-500 hover:bg-yellow-600">
                            <a href="{{ route('admin.clean-food.show', $data->id) }}">
                                Detail
                            </a>
                        </x-edit-button>
                        <form action="{{ route('admin.article.destroy', $data->id) }}" method="POST" id="delete-form-{{ $data->id }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit" class="delete-button w-15 h-8" data-id="{{ $data->id }}">
                                Hapus
                            </x-danger-button>
                        </form>
                    </div>
                </td>
            </x-table.tr>
            @endforeach
        </x-table.tbody>
    </table>
</div>
@endsection