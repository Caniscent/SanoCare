@extends('admin.layouts.app')

@section('title', 'Makanan Pilihan')

@section('content')

<div class="mt-12 overflow-x-auto">
    <h3 class="mb-4 text-xl font-bold">Data Makanan</h3>
    <div class="flex items-center gap-2 mb-4">
        <x-primary-button>
            <a href="{{route('admin.clean-food.create')}}">
                Tambah
            </a>
        </x-primary-button>
        <x-edit-button class="bg-yellow-500 w-15 hover:bg-yellow-600">
            <a href="{{route('admin.food-export')}}">
                Export
            </a>
        </x-edit-button>
        <form action="{{route('admin.food-import')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="import" required>
            <x-edit-button>Import</x-edit-button>
        </form>
    </div>
    <table id="Table" class="w-full text-sm border border-collapse border-gray-200 table-auto sm:text-base">
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
                <td class="px-6 py-3 text-center">
                    <div class="flex justify-center gap-2">
                        <x-edit-button class="h-8 w-15">
                            <a href="{{ route('admin.clean-food.edit', $data->id) }}">
                                Edit
                            </a>
                        </x-edit-button>
                        <x-edit-button class="h-8 bg-yellow-500 w-15 hover:bg-yellow-600">
                            <a href="{{ route('admin.clean-food.show', $data->id) }}">
                                Detail
                            </a>
                        </x-edit-button>
                        <form action="{{ route('admin.clean-food.destroy', $data->id) }}" method="POST" id="delete-form-{{ $data->id }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit" class="h-8 delete-button w-15" data-id="{{ $data->id }}">
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
