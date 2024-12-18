@extends('layouts.app')

@section('title', 'History Meal Plan')

@section('content')
<section class="min-h-screen">
    <div class="container mx-auto pt-[4rem]">
        <h1 class="text-4xl font-bold mb-4 text-center text-gray-900 pb-12">Histori Rencana Makan</h1>

        @foreach($groupedMealPlans as $index => $mealPlanGroup)
            <div class="mb-6">
                <div class="flex justify-between items-center bg-blue-500 hover:bg-blue-600 text-white mb-2 p-4 cursor-pointer"
                    onclick="toggleMealPlan({{ $index }})">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-3">
                            <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                        </svg>
                        Meal Plan {{ $index + 1 }}
                    </div>

                    <div class="text-right">
                        Dibuat Pada: {{ $mealPlanGroup[0]->created_at->format('d-m-Y') }}
                    </div>
                    <button type="button" id="openDeleteModal" class="text-red-500 hover:underline">
                        Hapus
                    </button>
                </div>
                <input type="checkbox" id="delete-confirm-modal" class="modal-toggle" />
                <div class="modal">
                    <div class="modal-box bg-gray-900">
                        <h3 class="font-bold text-lg text-white">Konfirmasi Penghapusan Histori Rencana Makan</h3>
                        <p class="text-white">Tindakan anda sekarang akan menghapus histori yang dipilih, apakah anda ingin melanjutkan?</p>
                        <div class="modal-action justify-center">
                            <label for="delete-confirm-modal" class="btn bg-gray-400 hover:bg-gray-500 text-gray-900">Tidak</label>
                            <button id="confirmDeleteButton" class="btn btn-error">Ya, Lanjutkan</button>
                        </div>
                    </div>
                </div>
                <form action="{{ route('log.destroy', ['groupIndex' => $index]) }}" id="deleteForm" method="post" class="inline">
                    @csrf
                    @method('DELETE')
                </form>


                <div id="meal-plan-{{ $index }}" class="hidden mt-2">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-400 text-sm sm:text-base">
                            <thead class="text-gray-900">
                                <tr>
                                    <x-table.th class="text-center">Hari</x-table.th>
                                    <x-table.th class="text-center">Meal Plan</x-table.th>
                                    <x-table.th class="text-center">Tanggal Pembuatan</x-table.th>
                                </tr>
                            </thead>
                            <x-table.tbody class="text-gray-900">
                                @foreach($mealPlanGroup as $log)
                                    <x-table.tr>
                                        <x-table.td class="text-center">{{ $log->day }}</x-table.td>
                                        <x-table.td class="">
                                            <ul>
                                                @foreach(json_decode($log->meal_plan, true) as $mealType => $mealItems)
                                                    <li><strong>{{ ucfirst($mealType) }}:</strong>
                                                        <ul>
                                                            @foreach($mealItems as $food)
                                                                <li>{{ $food['food_name'] }} {{ $food['portion'] }} ({{$food['calories']}} kalori)</li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </x-table.td>
                                        <x-table.td class="text-center">{{ $log->created_at->format('d-m-Y H:i:s') }}</x-table.td>
                                    </x-table.tr>
                                @endforeach
                            </x-table.tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<script>
    function toggleMealPlan(index) {
        const mealPlan = document.getElementById(`meal-plan-${index}`);
        mealPlan.classList.toggle("hidden");
    }

    document.getElementById('openDeleteModal').addEventListener('click', function() {
        document.getElementById('delete-confirm-modal').checked = true;
    });
    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        document.getElementById('deleteForm').submit();
    });
</script>
@endsection
