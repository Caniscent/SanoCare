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
            <tr class="bg-gray-150">
                <x-table.th>No</x-table.th>
                <x-table.th>Judul</x-table.th>
                <x-table.th class="hidden sm:table-cell">Konten</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th class="hidden sm:table-cell">Publish</x-table.th>
                <x-table.th>Aksi</x-table.th>
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
                    <x-status-label class="border-green-500 text-green-500">
                        diterbitkan
                    </x-status-label>         
                    @elseif ($data->status == 'draft')
                    <x-status-label class="border-yellow-500 text-yellow-500">
                        draft
                    </x-status-label>  
                    @elseif ($data->status == 'archived')
                    <x-status-label class="border-red-500 text-red-500">
                        diarsipkan
                    </x-status-label>  
                                                   
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
@endsection