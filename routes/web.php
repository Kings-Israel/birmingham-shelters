<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminsManagementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandlordListingController;
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

// Listing Controller
Route::get('listing/all-landlordlisting', [LandlordListingController::class, 'all_listings'])->name('listing.index');
Route::get('listing/add/basicinfo', [LandlordListingController::class, 'basic_info'])->name('listing.add.basic_info');
Route::get('listing/add/clientgroupinfo/{id}', [LandlordListingController::class, 'client_info'])->name('listing.add.client_info');
Route::get('listing/add/listingdocuments/{id}', [LandlordListingController::class, 'listing_documents'])->name('listing.add.listing_documents');
Route::get('listing/add/listingimages/{id}', [LandlordListingController::class, 'listing_images'])->name('listing.add.listing_images');
Route::post('listing/add/basicinfo', [LandlordListingController::class, 'submit_basic_info'])->name('listing.add.submit_basic_info');
Route::post('listing/add/clientinfo', [LandlordListingController::class, 'submit_clientgroup_info'])->name('listing.add.submit_client_info');
Route::post('listing/add/listingdocuments', [LandlordListingController::class, 'submit_listing_documents'])->name('listing.add.submit_documents');
Route::post('listing/add/listingimages', [LandlordListingController::class, 'submit_listing_images'])->name('listing.add.submit_images');
Route::delete('listing/delete/listing/{id}', [LandlordListingController::class, 'delete_listing'])->name('listing.delete');

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
