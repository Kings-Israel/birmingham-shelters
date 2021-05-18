<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminsManagementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostAjaxRedirect;
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
Route::get('/loggedIn', [PostAjaxRedirect::class, 'ajaxRedirect'])->name('loggedIn');
Route::get('/user/home', [HomeController::class, 'user'])->name('user.index');
Route::get('/landlord/home', [HomeController::class, 'landlord'])->name('landlord.index');
Route::get('/volunteer/home', [HomeController::class, 'volunteer'])->name('volunteer.index');

// Statutory Documents Route
Route::post('/statutory/store', [DocumentController::class, 'store'])->name('statutory.store');
Route::delete('/statutory/delete/{id}', [DocumentController::class, 'delete'])->name('statutory.delete');

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

// User Profile Route
Route::view('/profile', 'user-profile')->middleware(['auth', 'verified'])->name('user-profile');
