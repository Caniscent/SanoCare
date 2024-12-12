<?php

// use App\Http\Controllers\AdminCleanFoodController;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealPlanLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Admin\AdminFoodTypeController;

Route::middleware('backbrowser')->group(function (){
    Auth::routes();

});
Route::get('/', function () {
    return view('pages.home.index');
})->name('home');

// auth
Route::post('/register', [RegisterController::class, 'handleStep'])->name('register.step');
Route::get('/register/{step}', [RegisterController::class, 'showRegistrationForm'])->name('register.showStep');
Route::get('/password/verify', [ConfirmPasswordController::class, 'passwordVerify'])->name('password.verify');
Route::post('/password/verify', [ConfirmPasswordController::class, 'passwordVerifyProcess'])->name('password.verify-process');
Route::get('/password/email', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::prefix('/article')->name('article.')->group( function () {
    Route::get('/',[UserArticleController::class, 'index'])->name('index');
    Route::get('/show/{slug}',[UserArticleController::class, 'show'])->name('detail');
});

// admin
Route::middleware(['auth', 'role:admin', 'backbrowser'])->group(function () {
    Route::prefix('/admin')->name('admin.')->group( function(){
        Route::get('/', function(){return view('admin.pages.home.index');})->name('index');
        Route::resource('article', Admin\ArticleController::class);
        Route::resource('profile', Admin\AdminProfileController::class);
        Route::resource('clean-food', Admin\AdminCleanFoodController::class)->except('destroy');
        Route::resource('food-group', Admin\AdminFoodGroupController::class );
        Route::resource('food-type', AdminFoodTypeController::class);
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    });
});

// user
Route::middleware(['auth', 'role:user', 'backbrowser'])->group(function () {
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
        Route::get('/',[MealPlanLogController::class, 'index'])->name('index');
        Route::get('/create',[MealPlanLogController::class, 'create'])->name('create');
        Route::post('/store', [MealPlanLogController::class, 'store'])->name('store');
        Route::get('/edit/{id}',[MealPlanLogController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [MealPlanLogController::class, 'update'])->name('update');
        Route::delete('/delete/{Log_id}', [MealPlanLogController::class, 'destroy'])->name('destroy');
    });
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
