@extends('admin.layouts.app')

@section('title', 'Kelompok Makanan')

@section('content')

<div class="overflow-x-auto mt-12">
    <h3 class="text-xl font-bold mb-4">Data Tipe</h3>
    <div class="flex justify-between items-center mb-4">
        <x-primary-button>
            <a href="{{route('admin.food-type.create')}}">
                Tambah
            </a>
        </x-primary-button>
    </div>
    <table id="Table" class="table-auto w-full border-collapse border border-gray-200 text-sm sm:text-base">
        <thead>
            <tr class="bg-gray-150">
                <x-table.th>No</x-table.th>
                <x-table.th>Nama</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Deskripsi</x-table.th>
                <x-table.th>Aksi</x-table.th>
            </tr>
        </thead>
        <x-table.tbody>
            @foreach ($food as $data)
            <x-table.tr>
                <x-table.td>{{ $loop->iteration }}</x-table.td>
                <x-table.td>{{ $data->type }}</x-table.td>
                <x-table.td>
                    @if ($data->status == true)
                        <x-status-label class="border-green-500 text-green-500">
                            aktif
                        </x-status-label>
                    @elseif ($data->status == false)
                        <x-status-label class="border-red-500 text-red-500">
                                tidak aktif
                        </x-status-label>
                    @endif
                </x-table.td>
                <x-table.td>{{ $data->description }}</x-table.td>
                <td class="py-3 px-6 text-center">
                    <div class="flex justify-center gap-2">
                <x-edit-button class="w-15 h-8">
                    <a href="{{ route('admin.food-type.edit', $data->id) }}">
                        Edit
                    </a>
                </x-edit-button>
            </td>
        </div>
            </x-table.tr>
            @endforeach
        </x-table.tbody>
    </table>
</div>
@endsection