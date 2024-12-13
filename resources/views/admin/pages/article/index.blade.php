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
    <div class="overflow-x-auto">
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
                            Diterbitkan
                        </x-status-label>         
                        @elseif ($data->status == 'draft')
                        <x-status-label class="border-yellow-500 text-yellow-500">
                            Draft
                        </x-status-label>  
                        @elseif ($data->status == 'archived')
                        <x-status-label class="border-red-500 text-red-500">
                            Diarsipkan
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
    
    
    {{-- <div class="space-y-4 sm:hidden">
        @foreach ($article as $data)
        <div class="bg-white border border-gray-200 shadow-sm rounded-lg p-4">
            <div class="flex justify-between">
                <span class="font-bold text-gray-700">No   :</span>
                <span>{{ $loop->iteration }}</span>
            </div>
            <div class="flex justify-between mt-2">
                <span class="font-bold text-gray-700">Judul:</span>
                <span>{{ $data->title }}</span>
            </div>
            <div class="flex justify-between mt-2">
                <span class="font-bold text-gray-700">Konten:</span>
                <span class="text-right">{!! \Illuminate\Support\Str::limit($data->content, 40) !!}</span>
            </div>
            <div class="flex justify-between mt-2">
                <span class="font-bold text-gray-700">Status:</span>
                <span>
                    @if ($data->status == 'published')
                    <x-status-label class="border-green-500 text-green-500">
                        Diterbitkan
                    </x-status-label>
                    @elseif ($data->status == 'draft')
                    <x-status-label class="border-yellow-500 text-yellow-500">
                        Draft
                    </x-status-label>
                    @elseif ($data->status == 'archived')
                    <x-status-label class="border-red-500 text-red-500">
                        Diarsipkan
                    </x-status-label>
                    @endif
                </span>
            </div>
            <div class="flex justify-between mt-2">
                <span class="font-bold text-gray-700">Publish:</span>
                <span>{{ $data->published_at ? $data->published_at->format('d M Y') : '-' }}</span>
            </div>
            <div class="flex justify-center gap-2 mt-4">
                <x-edit-button>
                    <a href="{{ route('admin.article.edit', $data->id) }}">Edit</a>
                </x-edit-button>
                <form action="{{ route('admin.article.destroy', $data->id) }}" method="POST" id="delete-form-{{ $data->id }}">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit" class="delete-button" data-id="{{ $data->id }}">
                        Hapus
                    </x-danger-button>
                </form>
            </div>
        </div>
        @endforeach
    </div> --}}
    
</div>
@endsection