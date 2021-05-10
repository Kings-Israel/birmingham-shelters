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
        Route::get('/{admin}/edit', [AdminsManagementController::class, 'edit_admin'])->name('edit');
    });
});


// !! TEMPORARY DEV ROUTES !!
// TODO: Remove after merging authentication feature
Route::get("_salogin", function() {
    Auth::login(App\Models\User::whereEmail('super_admin@mail.com')->first(), $remember = true);
    return redirect('/admin/admins');
})->name('temp-salogin');

Route::get("_salogout", function() {
    Auth::logout();
    return redirect('/');
})->name('temp-logout');

