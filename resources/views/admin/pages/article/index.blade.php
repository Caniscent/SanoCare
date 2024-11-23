@extends('admin.layouts.app')

@section('title', 'Artikel')

@section('content')

<div class="overflow-x-auto">
    <h3 class="text-2xl font-bold mb-4">Data Artikel</h3>
    <div class="flex justify-between items-center mb-4">
        <x-primary-button>
            <a href="{{route('admin.article.create')}}">
                Tambah
            </a>
        </x-primary-button>
    </div>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            timer: 2000, // durasi alert ditampilkan
            showConfirmButton: false
        });
    </script>
     @endif
    <table class="table-auto w-full border-collapse border border-gray-200 text-sm sm:text-base">
        <thead>
            <tr class="bg-gray-200">
                <x-table.th>No</x-table.th>
                <x-table.th>Judul</x-table.th>
                <x-table.th>Konten</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Tanggal Dipublish</x-table.th>
                <x-table.th>Tanggal Dibuat</x-table.th>
                <th class="text-gray-900 text-center">Aksi</th>
            </tr>
        </thead>
        <x-table.tbody>
            @foreach ($article as $data)
            <x-table.tr>
                <x-table.td>{{ $loop->iteration }}</x-table.td>
                <x-table.td>{{ $data->title }}</x-table.td>
                <x-table.td>{!! \Illuminate\Support\Str::limit($data->content, 40) !!}</x-table.td>
                <x-table.td>{{ $data->status }}</x-table.td>
                <x-table.td>{{ $data->published_at ? $data->published_at->format('d M Y') : '-' }}</x-table.td>
                <x-table.td>{{ $data->created_at->format('d M Y') }}</x-table.td>
                <td class="py-3 px-6 text-center">
                    <div class="flex justify-center gap-2">
                        <x-edit-button>
                            <a href="{{ route('admin.article.edit', $data->id) }}">
                                Edit
                            </a>
                        </x-edit-button>
                        <form action="{{ route('admin.article.destroy', $data->id) }}" method="POST" class="inline-block" id="delete-form-{{ $data->id }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit" class="delete-button" data-id="{{ $data->id }}">
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
