@extends('admin.layouts.app')

@section('title', 'Kelompok Makanan')

@section('content')

<div class="overflow-x-auto mt-12">
    <h3 class="text-xl font-bold mb-4">Data Kelompok</h3>
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
                <x-table.th>Nama Kelompok</x-table.th>
            </tr>
        </thead>
        <x-table.tbody>
            @foreach ($food as $data)
            <x-table.tr>
                <x-table.td  class="text-left">{{ $loop->iteration }}</x-table.td>
                <x-table.td>{{ $data->group }}</x-table.td>
            </x-table.tr>
            @endforeach
        </x-table.tbody>
    </table>
</div>
@endsection