@extends('admin.layouts.app')

@section('title', 'Artikel')

@section('content')

<div class="overflow-x-auto mt-12">
    <h3 class="text-xl font-bold mb-4">Data Artikel</h3>
    <div class="flex justify-between items-center mb-4">
        <x-primary-button>
            <a href="{{route('admin.article.create')}}">
                Tambah
            </a>
        </x-primary-button>
    </div>
    <table id="Table" class="table-auto w-full border-collapse border border-gray-200 text-sm sm:text-base">
        <thead>
            <tr class="bg-gray-200">
                <x-table.th>No</x-table.th>
                <x-table.th>Judul</x-table.th>
                <x-table.th class="hidden sm:table-cell">Konten</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th class="hidden sm:table-cell">Publish</x-table.th>
                <th class="text-gray-900 text-center">Aksi</th>
            </tr>
        </thead>
        <x-table.tbody>
            @foreach ($article as $data)
            <x-table.tr>
                <x-table.td>{{ $loop->iteration }}</x-table.td>
                <x-table.td>{{ $data->title }}</x-table.td>
                <x-table.td class="hidden sm:table-cell">{!! \Illuminate\Support\Str::limit($data->content, 40) !!}</x-table.td>
                <x-table.td>
                    @if ($data->status == 'published')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>             
                    @elseif ($data->status == 'draft')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="yellow" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                      </svg>
                    @elseif ($data->status == 'archived')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                      </svg>
                                                   
                    @endif
                </x-table.td>
                <x-table.td class="hidden sm:table-cell">{{ $data->published_at ? $data->published_at->format('d M Y') : '-' }}</x-table.td>
                <td class="py-3 px-6 text-center">
                    <div class="flex justify-center gap-2">
                        <x-edit-button class="w-15 h-8">
                            <a href="{{ route('admin.article.edit', $data->id) }}">
                                Edit
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
<script>
    document.querySelectorAll('.delete-button').forEach((button) => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah form submit langsung
            const formId = 'delete-form-' + button.getAttribute('data-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus dan tidak bisa dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, kirimkan form
                    document.getElementById(formId).submit();
                }
            });
        });
    });
</script>
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
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready( function () {
    $('#Table').DataTable();
} );
</script>