<?php

use App\Http\Controllers\AdminsManagementController;
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
