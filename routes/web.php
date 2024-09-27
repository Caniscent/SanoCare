<?php

use App\Http\Controllers\CheckController;
use App\Http\Controllers\HabitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home.index');
});

Route::prefix('/check')->name('check.')->group( function () {
    Route::get('/',[CheckController::class, 'index'])->name('index');
    Route::get('/create',[CheckController::class, 'create'])->name('create');
    Route::post('/store', [CheckController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[CheckController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [CheckController::class, 'update'])->name('update');
    Route::delete('/delete/{Check_id}', [CheckController::class, 'destroy'])->name('destroy');
});

Route::prefix('/habits')->name('habits.')->group( function () {
    Route::get('/',[HabitController::class, 'index'])->name('index');
    Route::get('/create',[HabitController::class, 'create'])->name('create');
    Route::post('/store', [HabitController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[HabitController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [HabitController::class, 'update'])->name('update');
    Route::delete('/delete/{Habits_id}', [HabitController::class, 'destroy'])->name('destroy');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
