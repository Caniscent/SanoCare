<?php

use App\Http\Controllers\ChecksController;
use App\Http\Controllers\Checkv2Controller;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('pages.home.index');
});

Route::prefix('/check')->name('check.')->group( function () {
    Route::get('/',[ChecksController::class, 'index'])->name('index');
    Route::get('/create',[ChecksController::class, 'create'])->name('create');
    Route::post('/store', [ChecksController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[ChecksController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ChecksController::class, 'update'])->name('update');
    Route::delete('/delete/{Check_id}', [ChecksController::class, 'destroy'])->name('destroy');
});

// Route::prefix('/habits')->name('habits.')->group( function () {
//     Route::get('/',[HabitController::class, 'index'])->name('index');
//     Route::get('/create',[HabitController::class, 'create'])->name('create');
//     Route::post('/store', [HabitController::class, 'store'])->name('store');
//     Route::get('/edit/{id}',[HabitController::class, 'edit'])->name('edit');
//     Route::put('/update/{id}', [HabitController::class, 'update'])->name('update');
//     Route::delete('/delete/{Habits_id}', [HabitController::class, 'destroy'])->name('destroy');
// });

Route::prefix('/profile')->name('profile.')->group( function () {
    Route::get('/',[ProfileController::class, 'index'])->name('index');
    Route::get('/create',[ProfileController::class, 'create'])->name('create');
    Route::post('/store', [ProfileController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[ProfileController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [ProfileController::class, 'update'])->name('update');
    Route::delete('/delete/{Profile_id}', [ProfileController::class, 'destroy'])->name('destroy');
});

Route::prefix('/checkv2')->name('checkv2.')->group( function () {
    Route::get('/create', [Checkv2Controller::class, 'create'])->name('create');

});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
