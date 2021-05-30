<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminShowListingController;
use App\Http\Controllers\AdminsManagementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandlordListingController;
use App\Http\Controllers\PostAjaxRedirect;
use App\Http\Livewire\AdminListingsList;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');
Route::view('/contact', 'pages.contact');
Route::view('/about', 'pages.about');
Route::view('/privacy', 'pages.privacy-policy');

Auth::routes(['verify' => true]);

Route::view('/profile', 'user-profile')->middleware(['auth', 'verified'])->name('user-profile');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/loggedIn', [PostAjaxRedirect::class, 'ajaxRedirect'])->name('loggedIn');
Route::get('/user/home', [HomeController::class, 'user'])->name('user.index');
Route::get('/landlord/home', [HomeController::class, 'landlord'])->name('landlord.index');
Route::get('/volunteer/home', [HomeController::class, 'volunteer'])->name('volunteer.index');

// Landlord Listing Controller
Route::get('listing/all', [LandlordListingController::class, 'all_listings'])->name('listing.view.all');
Route::get('listing/{listing}', [LandlordListingController::class, 'view_listing'])->name('listing.view.one');
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
    Route::group([
        'prefix' => 'admins',
        'as' => 'admins.',
        'middleware' => ['userType:super_admin']
    ], function () {
        Route::get('/', [AdminsManagementController::class, 'index'])->name('index');
        Route::get('/create', [AdminsManagementController::class, 'create'])->name('create');
        Route::get('/{admin}/edit', [AdminsManagementController::class, 'edit'])->name('edit');
    });

    // Listing management
    Route::prefix('listings')->name('admin.listings.')->group(function () {
        Route::get('/', AdminListingsList::class)->name('index');
        Route::get('/{listing}', AdminShowListingController::class)->name('show');
    });
});
