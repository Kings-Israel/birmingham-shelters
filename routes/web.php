<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PostAjaxRedirect;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('index');
});

Auth::routes(['verify' => true]);

Route::get('/email/verify', function() {
    return view('verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    $role = Auth::user()->user_type;

    if ($role == 'user') {
        return redirect('/user/home');
    } elseif ($role == 'landlord') {
        return redirect('/landlord/home');
    } elseif($role == 'volunteer') {
        return redirect('/volunteer/home');
    }
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/loggedIn', [App\Http\Controllers\PostAjaxRedirect::class, 'ajaxRedirect'])->name('loggedIn');
Route::get('/user/home', [App\Http\Controllers\HomeController::class, 'user'])->name('user.index');
Route::get('/landlord/home', [App\Http\Controllers\HomeController::class, 'landlord'])->name('landlord.index');
Route::get('/volunteer/home', [App\Http\Controllers\HomeController::class, 'volunteer'])->name('volunteer.index');
// Statutory Documents Route
Route::post('/statutory/store', [DocumentController::class, 'store'])->name('statutory.store');
Route::delete('/statutory/delete/{id}', [DocumentController::class, 'delete'])->name('statutory.delete');