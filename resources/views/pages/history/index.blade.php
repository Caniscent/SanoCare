@extends('layouts.app')

@section('title', 'History Meal Plan')

@section('content')
<div class="container mx-auto my-10">
    <h1 class="text-4xl font-bold text-center mb-10">Riwayat Meal Plan</h1>

    @if($histories->isEmpty())
        <p class="text-center text-gray-500">Belum ada riwayat meal plan yang tersimpan.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($histories as $history)
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">{{ $history->day }}</h2>
                        <ul class="list-disc list-inside">
                            @php
                                $mealPlan = json_decode($history->meal_plan, true);
                            @endphp
                            @foreach($mealPlan as $mealTime => $details)
                                <li>
                                    <strong>{{ $mealTime }}:</strong>
                                    <ul class="ml-4">
                                        @foreach($details as $detail)
                                            <li>{{ $detail }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                        <p class="text-sm text-gray-500">Dibuat pada: {{ $history->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
