<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminsManagementController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');

Auth::routes(['verify' => true]);

Route::view('/email/verify', 'verify')->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    $role = Auth::user()->user_type;

    if ($role == 'user') {
        return redirect('/user/home');
    } elseif ($role == 'landlord') {
        return redirect('/landlord/home');
    } elseif ($role == 'volunteer') {
        return redirect('/volunteer/home');
    } else {
        return redirect('/');
    }
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/loggedIn', [App\Http\Controllers\PostAjaxRedirect::class, 'ajaxRedirect'])->name('loggedIn');
Route::get('/user/home', [App\Http\Controllers\HomeController::class, 'user'])->name('user.index');
Route::get('/landlord/home', [App\Http\Controllers\HomeController::class, 'landlord'])->name('landlord.index');
Route::get('/volunteer/home', [App\Http\Controllers\HomeController::class, 'volunteer'])->name('volunteer.index');

// Admin routes
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::get('/', AdminDashboardController::class)->name('admin-dashboard');

    // Admins Resource Routes
    Route::prefix('admins')->name('admins.')->group(function () {
        Route::get('/', [AdminsManagementController::class, 'all_admins'])->name('index');
        Route::get('/create', [AdminsManagementController::class, 'create_admin'])->name('create');
        Route::get('/{admin}/edit', [AdminsManagementController::class, 'edit_admin'])->name('edit');
    });
});
