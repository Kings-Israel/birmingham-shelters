<?php

use App\Http\Controllers\AdminsManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Admin routes
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::prefix('admins')->name('admins.')->group(function () {
        Route::get('/', [AdminsManagementController::class, 'all_admins'])->name('index');
        Route::get('/create', [AdminsManagementController::class, 'create_admin'])->name('create');
    });
});


// !! TEMPORARY DEV ROUTES !!
Route::get("_salogin", function() {
    Auth::login(App\Models\User::whereEmail('super_admin@mail.com')->first(), $remember = true);
    return redirect('/');
});

Route::get("_salogout", function() {
    Auth::logout();
    return redirect('/');
});

