@extends('layouts.app')

@section('title', 'History Meal Plan')

@section('content')
    <div class="container mx-auto pt-[4rem] pb-[24.1rem]">
        <h1 class="text-4xl font-bold mb-4 text-center text-gray-900 pb-12">Meal Plan Log</h1>
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead class="text-gray-900">
                    <tr>
                        <th>Hari</th>
                        <th>Meal Plan</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900">
                    @foreach($mealPlanLogs as $log)
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
@endsection
