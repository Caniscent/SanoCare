<?php

use App\Http\Controllers\ChecksController;
use App\Http\Controllers\Checkv2Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoryController;
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

Route::prefix('/profile')->name('profile.')->group( function () {
    Route::get('/',[ProfileController::class, 'index'])->name('index');
    Route::get('/create',[ProfileController::class, 'create'])->name('create');
    Route::post('/store', [ProfileController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[ProfileController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [ProfileController::class, 'update'])->name('update');
    Route::delete('/delete/{Profile_id}', [ProfileController::class, 'destroy'])->name('destroy');
});

Route::prefix('/history')->name('history.')->group( function () {
    Route::get('/',[HistoryController::class, 'index'])->name('index');
    Route::get('/create',[HistoryController::class, 'create'])->name('create');
    Route::post('/store', [HistoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[HistoryController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [HistoryController::class, 'update'])->name('update');
    Route::delete('/delete/{History_id}', [HistoryController::class, 'destroy'])->name('destroy');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
