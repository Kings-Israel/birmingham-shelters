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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');
Route::view('/contact', 'pages.contact');
Route::view('/about', 'pages.about');
Route::view('/privacy', 'pages.privacy-policy');


Auth::routes(['verify' => true]);

Route::view('/profile', 'user-profile')->middleware(['auth', 'verified'])->name('user-profile');

Route::get('/loggedIn', PostAjaxRedirect::class)->name('loggedIn');
Route::get('/user', [HomeController::class, 'user'])->name('user.index');
Route::get('/landlord', [HomeController::class, 'landlord'])->name('landlord.index');
Route::get('/agent', [HomeController::class, 'agent'])->name('agent.index');
Route::get('/agent/referees', [HomeController::class, 'agent_referees'])->name('agent.referees');
Route::group(['prefix' => '/profile', 'as' => 'profile.'], function() {
    Route::get('/{user}', [HomeController::class, 'show_profile'])->name('show');
    Route::post('/update', [HomeController::class, 'update_profile'])->name('update');
});

Route::group([
    'prefix' => 'landlord/listing',
    'as' => 'listing.',
    'middleware' => ['userType:landlord']
    ], 
    function() {
        Route::get('/all', [LandlordListingController::class, 'all_listings'])->name('view.all');
        Route::get('/{listing}', [LandlordListingController::class, 'view_listing'])->name('view.one');
        Route::get('/add/basicinfo', [LandlordListingController::class, 'basic_info'])->name('add.basic_info');
        Route::get('/add/clientgroupinfo/{id}', [LandlordListingController::class, 'client_info'])->name('add.client_info');
        Route::get('/add/listingdocuments/{id}', [LandlordListingController::class, 'listing_documents'])->name('add.listing_documents');
        Route::get('/add/listingimages/{id}', [LandlordListingController::class, 'listing_images'])->name('add.listing_images');
        Route::post('/add/basicinfo', [LandlordListingController::class, 'submit_basic_info'])->name('add.submit_basic_info');
        Route::post('/add/clientinfo', [LandlordListingController::class, 'submit_clientgroup_info'])->name('add.submit_client_info');
        Route::post('/add/listingdocuments', [LandlordListingController::class, 'submit_listing_documents'])->name('add.submit_documents');
        Route::post('/add/listingimages', [LandlordListingController::class, 'submit_listing_images'])->name('add.submit_images');
        Route::delete('/{listing}/delete', [LandlordListingController::class, 'delete_listing'])->name('delete');
});

Route::delete('listing-images/{listing_image}/delete', [LandlordListingController::class, 'delete_removed_image'])->name('listing-images.delete');

// User listing controller
Route::group(['prefix'=> '/listing', 'as' => 'listing.'], function () {
    Route::get('/all', [UserListingController::class, 'listings'])->name('all');
    Route::geT('/{listing}', [UserListingController::class, 'listing'])->name('one');
    Route::post('/inquiry', [ListingInquiryController::class, 'submit_inquiry'])->name('inquiry');
});

// User Listing Booking Controller
Route::post('/listing/booking/user', [UserBookingController::class, 'submit_booking'])->name('submit.booking');

// Accomodation referral forms wizard
Route::prefix('/referral')->group(function () {
    Route::get('/', [UserMetadataController::class, 'show_select_referral_type_form'])->name('referral-form.show');
    Route::get('/self', [UserMetadataController::class, 'self_referral'])->name('referral.self-referral');
    Route::get('/agency', [UserMetadataController::class, 'agency_referral'])->name('referral.agency-referral');
    Route::get('/income/{userMetadata}', [UserMetadataController::class, 'add_income_info'])->name('referral.add.income-info');
    Route::get('/address-history/{userMetadata}', [UserMetadataController::class, 'add_address_history_info'])->name('referral.add.address-history-info');
    Route::get('/health/{userMetadata}', [UserMetadataController::class, 'add_health_info'])->name('referral.add.health-info');
    Route::get('/support-needs/{userMetadata}', [UserMetadataController::class, 'add_support_info'])->name('referral.add.support-info');
    Route::get('/risk-assessment/{userMetadata}', [UserMetadataController::class, 'add_risk_assessment'])->name('referral.add.risk-assessment');
    Route::get('/consent/{userMetadata}', [UserMetadataController::class, 'add_consent'])->name('referral.add.consent');
    Route::post('/submit', [UserMetadataController::class, 'submit_referral_form'])->name('referral-form.submit');
    Route::post('/income/submit', [UserMetadataController::class, 'submit_income_info'])->name('income-form.submit');
    Route::post('/address/submit', [UserMetadataController::class, 'submit_address_history_info'])->name('address-form.submit');
    Route::post('/health/submit', [UserMetadataController::class, 'submit_health_info'])->name('health-form.submit');
    Route::post('/support/submit', [UserMetadataController::class, 'submit_support_info'])->name('support-form.submit');
    Route::post('/risk-assessment/submit', [UserMetadataController::class, 'submit_risk_assessment'])->name('risk-assessment-form.submit');
    Route::post('/consent/submit', [UserMetadataController::class, 'submit_consent_form'])->name('consent-form.submit');
});

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
