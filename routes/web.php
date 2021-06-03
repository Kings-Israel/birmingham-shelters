<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminShowListingController;
use App\Http\Controllers\AdminsManagementController;
use App\Http\Controllers\UserListingController;
use App\Http\Controllers\UserMetadataController;
use App\Http\Controllers\ListingInquiryController;
use App\Http\Controllers\UserBookingController;
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
Route::delete('listing/delete/{id}', [LandlordListingController::class, 'delete_listing'])->name('listing.delete');

// User listing controller
Route::get('/user/listing/all', [UserListingController::class, 'listings'])->name('user.listing.all');
Route::get('/user/listing/{listing}', [UserListingController::class, 'listing'])->name('user.listing.one');

// Listing enquiry routes
Route::post('/user/listing/inquiry', [ListingInquiryController::class, 'submit_inquiry'])->name('user.submit.inquiry');

// User Listing Booking Controller
Route::post('/user/listing/booking', [UserBookingController::class, 'submit_booking'])->name('user.submit.booking');

// Accomodation referral forms wizard
Route::get('/user/referral', [UserMetadataController::class, 'show_select_referral_type_form'])->name('referral-form.show');
Route::get('/user/referral/self', [UserMetadataController::class, 'self_referral'])->name('referral.self-referral');
Route::get('/user/referral/agency', [UserMetadataController::class, 'agency_referral'])->name('referral.agency-referral');
Route::get('/user/referral/income/{id}', [UserMetadataController::class, 'add_income_info'])->name('referral.add.income-info');
Route::get('/user/referral/address-history/{id}', [UserMetadataController::class, 'add_address_history_info'])->name('referral.add.address-history-info');
Route::get('/user/referral/health/{id}', [UserMetadataController::class, 'add_health_info'])->name('referral.add.health-info');
Route::get('/user/referral/support-needs/{id}', [UserMetadataController::class, 'add_support_info'])->name('referral.add.support-info');
Route::get('/user/referral/risk-assessment/{id}', [UserMetadataController::class, 'add_risk_assessment'])->name('referral.add.risk-assessment');
Route::get('/user/referral/consent/{userMetadata}', [UserMetadataController::class, 'add_consent'])->name('referral.add.consent');
Route::post('/user/referral/submit', [UserMetadataController::class, 'submit_referral_form'])->name('referral-form.submit');
Route::post('/user/referral/income/submit', [UserMetadataController::class, 'submit_income_info'])->name('income-form.submit');
Route::post('/user/referral/address/submit', [UserMetadataController::class, 'submit_address_history_info'])->name('address-form.submit');
Route::post('/user/referral/health/submit', [UserMetadataController::class, 'submit_health_info'])->name('health-form.submit');
Route::post('/user/referral/support/submit', [UserMetadataController::class, 'submit_support_info'])->name('support-form.submit');
Route::post('/user/referral/risk-assessment/submit', [UserMetadataController::class, 'submit_risk_assessment'])->name('risk-assessment-form.submit');
Route::post('/user/referral/consent/submit', [UserMetadataController::class, 'submit_consent_form'])->name('consent-form.submit');

// Admin routes
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::get('/', AdminDashboardController::class)->name('admin-dashboard');

    // Admins Resource Routes
    Route::prefix('admins')
        ->name('admins.')
        ->middleware('userType:super_admin')
        ->group(function () {
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

// User Profile Route
Route::view('/profile', 'user-profile')->middleware(['auth', 'verified'])->name('user-profile');
