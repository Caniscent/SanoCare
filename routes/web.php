<?php

use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('pages.home.index');
});

Route::prefix('/meal-plan')->name('meal-plan.')->group( function () {
    Route::get('/',[MealPlanController::class, 'index'])->name('index');
    Route::get('/create',[MealPlanController::class, 'create'])->name('create');
    Route::post('/store', [MealPlanController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[MealPlanController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [MealPlanController::class, 'update'])->name('update');
    Route::delete('/delete/{MealPlan_id}', [MealPlanController::class, 'destroy'])->name('destroy');
});

Route::prefix('/profile')->name('profile.')->group( function () {
    Route::get('/',[ProfileController::class, 'index'])->name('index');
    Route::get('/create',[ProfileController::class, 'create'])->name('create');
    Route::post('/store', [ProfileController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[ProfileController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [ProfileController::class, 'update'])->name('update');
    Route::delete('/delete/{Profile_id}', [ProfileController::class, 'destroy'])->name('destroy');
});

Route::prefix('/log')->name('log.')->group( function () {
    Route::get('/',[LogController::class, 'index'])->name('index');
    Route::get('/create',[LogController::class, 'create'])->name('create');
    Route::post('/store', [LogController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[LogController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [LogController::class, 'update'])->name('update');
    Route::delete('/delete/{Log_id}', [LogController::class, 'destroy'])->name('destroy');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
