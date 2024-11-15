@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-4">
                    <x-primary-button>
                        <a href="{{route('admin.article.create')}}">
                            Tambah Blog
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
                <x-table>
                    <thead>
                        <tr class="bg-gray-200">
                            <x-table.th>No</x-table.th>
                            <x-table.th>Judul</x-table.th>
                            <x-table.th>Konten</x-table.th>
                            <x-table.th>status</x-table.th>
                            <x-table.th>Tanggal dipublish</x-table.th>
                            <x-table.th>Tanggal dibuat</x-table.th>
                            <th class="text-gray-900 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <x-table.tbody>
                        @foreach ($article as $data)
                        <x-table.tr>
                        
                                
                            <x-table.td>{{$loop->iteration}}</x-table.td>
                            <x-table.td>{{$data->title}}</x-table.td>
                            <x-table.td>{!! \Illuminate\Support\Str::limit($data->content, 40) !!}</x-table.td>
                            <x-table.td>{{ $data->status }}</x-table.td>
                            <x-table.td>{{ $data->published_at ? $data->published_at->format('d M Y') : '-' }}</x-table.td>
                            <x-table.td>{{ $data->created_at->format('d M Y') }}</x-table.td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex justify-center gap-2">
                                <x-edit-button>
                                    <a href="{{ route('admin.article.edit', $data->id ) }}">
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
                </x-table>
            </div>
        </div>
    </div>
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

@endsection
