<?php

use App\Http\Controllers\CheckController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home.index');
});

Route::prefix('/check')->name('check')->group( function () {
    Route::get('/',[CheckController::class, 'index'])->name('index');
    Route::get('/manage',[CheckController::class, 'manage'])->name('manage');
    Route::get('/create',[CheckController::class, 'create'])->name('create');
    Route::post('/store', [CheckController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[CheckController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [CheckController::class, 'update'])->name('update');
    Route::delete('/delete/{Check_id}', [CheckController::class, 'destroy'])->name('destroy');
});
