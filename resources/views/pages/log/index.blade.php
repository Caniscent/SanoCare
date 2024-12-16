@extends('layouts.app')

@section('title', 'History Meal Plan')

@section('content')
    <div class="container mx-auto pt-[4rem] pb-[19rem]">
        <h1 class="text-4xl font-bold mb-4 text-center text-gray-900 pb-12">Histori Rencana Makan</h1>

        @foreach($groupedMealPlans as $index => $mealPlanGroup)
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <button class="btn bg-blue-400 hover:bg-blue-500 w-full text-center text-white" type="button"
                        onclick="toggleMealPlan({{ $index }})">
                        Meal Plan {{ $index + 1 }} - Dibuat Pada: {{ $mealPlanGroup[0]->created_at->format('d-m-Y') }}
                        {{-- <form action="{{ route('log.destroy', $index) }}" method="POST" class="ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error">Hapus</button>
                        </form> --}}
                    </button>
                </div>

                <div id="meal-plan-{{ $index }}" class="hidden mt-4">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead class="text-gray-900">
                                <tr>
                                    <th>Hari</th>
                                    <th>Meal Plan</th>
                                    <th>Tanggal Pembuatan</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-900">
                                @foreach($mealPlanGroup as $log)
                                    <tr>
                                        <td>{{ $log->day }}</td>
                                        <td>
                                            <ul>
                                                @foreach(json_decode($log->meal_plan, true) as $mealType => $mealItems)
                                                    <li><strong>{{ ucfirst($mealType) }}:</strong>
                                                        <ul>
                                                            @foreach($mealItems as $food)
                                                                <li>{{ $food['food_name'] }} ({{ $food['portion'] }})</li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function toggleMealPlan(index) {
            const mealPlan = document.getElementById(`meal-plan-${index}`);
            mealPlan.classList.toggle("hidden");
        }
    </script>
@endsection
