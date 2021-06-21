<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminShowListingController;
use App\Http\Controllers\AdminsManagementController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandlordListingController;
use App\Http\Controllers\ListingInquiryController;
use App\Http\Controllers\PostAjaxRedirect;
use App\Http\Controllers\RefereeDataController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\UserListingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Livewire\AdminListingsList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');
Route::view('/contact', 'pages.contact');
Route::view('/about', 'pages.about');
Route::view('/privacy', 'pages.privacy-policy');
Route::view('/inquiry-template', 'landlord.inquiry-reply-template');

Auth::routes(['verify' => true]);

Route::view('/email/verify', 'verify')->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    $role = Auth::user()->user_type;

    if ($role == 'user') {
        return redirect('/user');
    } elseif ($role == 'landlord') {
        return redirect('/landlord');
    } elseif ($role == 'agent') {
        return redirect('/agent');
    } else {
        return redirect('/');
    }
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::view('/profile', 'user-profile')->middleware(['auth', 'verified'])->name('user-profile');

Route::get('/loggedIn', PostAjaxRedirect::class)->name('loggedIn');
Route::get('/user', [HomeController::class, 'user'])->name('user.index');
Route::get('/landlord', [HomeController::class, 'landlord'])->name('landlord.index');
Route::get('/agent', [HomeController::class, 'agent'])->name('agent.index');
Route::get('/messages/{user}', [HomeController::class, 'messages'])->name('messages.show');
Route::get('/agent/referees', [HomeController::class, 'agentReferees'])->name('agent.referees.all');
Route::get('/referee/{referee}', [HomeController::class, 'referee'])->name('referees.referee');
Route::group(['prefix' => '/profile', 'as' => 'profile.'], function() {
    Route::get('/{user}', [HomeController::class, 'showProfile'])->name('show');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
});

Route::group(
    [
        'prefix' => 'landlord/listing',
        'as' => 'listing.',
        'middleware' => ['userType:landlord']
    ],
    function () {
        Route::get('/all', [LandlordListingController::class, 'allListings'])->name('view.all');
        Route::get('/{listing}', [LandlordListingController::class, 'viewListing'])->name('view.one');
        Route::get('/add/basicinfo', [LandlordListingController::class, 'basicInfo'])->name('add.basic_info');
        Route::get('/add/clientgroupinfo/{id}', [LandlordListingController::class, 'clientInfo'])->name('add.client_info');
        Route::get('/add/listingdocuments/{id}', [LandlordListingController::class, 'listingDocuments'])->name('add.listing_documents');
        Route::get('/add/listingimages/{id}', [LandlordListingController::class, 'listingImages'])->name('add.listing_images');
        Route::post('/add/basicinfo', [LandlordListingController::class, 'submitBasicInfo'])->name('add.submit_basic_info');
        Route::post('/add/clientinfo', [LandlordListingController::class, 'submitClientgroupInfo'])->name('add.submit_client_info');
        Route::post('/add/listingdocuments', [LandlordListingController::class, 'submitListingDocuments'])->name('add.submit_documents');
        Route::post('/add/listingimages', [LandlordListingController::class, 'submitListingImages'])->name('add.submit_images');
        Route::delete('/{listing}/delete', [LandlordListingController::class, 'deleteListing'])->name('delete');
        Route::get('/bookings/{listing}', [LandlordListingController::class, 'viewListingBookings'])->name('bookings.all');
        Route::get('/inquiries/{listing}', [LandlordListingController::class, 'viewListingInquiries'])->name('inquiries.all');
        Route::delete('/inquiry/{inquiry}/delete', [LandlordListingController::class, 'deleteInquiry'])->name('inquiry.delete');
        Route::get('/referee/pdf/{refereeData}', [RefereeDataController::class, 'getPdf'])->name('referee.pdf');
        Route::delete('/{listing}/delete-image', [LandlordListingController::class, 'deleteRemovedImage'])->name('images.delete');
        Route::post('/booking/check', [LandlordListingController::class, 'checkBookingStatus'])->name('booking.check');
        Route::get('/booking/{user_id}/{referee_id}/{listing_id}/delete', [LandlordListingController::class, 'deleteBooking'])->name('booking.delete');
    }
);

// User listing controller
Route::group(['prefix' => '/listing', 'as' => 'listing.'], function () {
    Route::get('/all', [UserListingController::class, 'listings'])->name('all');
    Route::post('/search', [UserListingController::class, 'searchListings'])->name('search');
    Route::get('/{listing}', [UserListingController::class, 'listing'])->name('one');
    Route::post('/booking/submit', [UserListingController::class, 'submitBooking'])->middleware(['auth', 'verified'])->name('submit.booking');
    Route::post('/inquiry', [ListingInquiryController::class, 'submitInquiry'])->name('inquiry');
    Route::post('/inquiry/response', [ListingInquiryController::class, 'replyToInquiry'])->name('inquiry.response');
    Route::get('/inquiry/response/email/{inquiry}', [ListingInquiryController::class, 'replyThroughMail'])->middleware(['auth', 'verified'])->name('reply.mail');
    Route::post('/inquiry/response/email', [ListingInquiryController::class, 'emailReply'])->middleware(['auth', 'verified'])->name('submit.email.reply');
    Route::delete('/inquiry/delete/{inquiry}', [ListingInquiryController::class, 'deleteInquiry'])->middleware(['auth', 'verified'])->name('user.inquiry.delete');
});

// Accomodation referral forms wizard
Route::prefix('/referral')->group(function () {
    Route::get('/self', [RefereeDataController::class, 'selfReferral'])->name('referral.self-referral');
    Route::get('/agency', [RefereeDataController::class, 'agencyReferral'])->name('referral.agency-referral');
    Route::get('/income/{refereeData}', [RefereeDataController::class, 'addIncomeInfo'])->name('referral.add.income-info');
    Route::get('/address-history/{refereeData}', [RefereeDataController::class, 'addAddressHistoryInfo'])->name('referral.add.address-history-info');
    Route::get('/health/{refereeData}', [RefereeDataController::class, 'addHealthInfo'])->name('referral.add.health-info');
    Route::get('/support-needs/{refereeData}', [RefereeDataController::class, 'addSupportInfo'])->name('referral.add.support-info');
    Route::get('/risk-assessment/{refereeData}', [RefereeDataController::class, 'addRiskAssessment'])->name('referral.add.risk-assessment');
    Route::get('/consent/{refereeData}', [RefereeDataController::class, 'addConsent'])->name('referral.add.consent');
    Route::post('/submit', [RefereeDataController::class, 'submitReferralForm'])->name('referral-form.submit');
    Route::post('/income/submit', [RefereeDataController::class, 'submitIncomeInfo'])->name('income-form.submit');
    Route::post('/address/submit', [RefereeDataController::class, 'submitAddressHistoryInfo'])->name('address-form.submit');
    Route::post('/health/submit', [RefereeDataController::class, 'submitHealthInfo'])->name('health-form.submit');
    Route::post('/support/submit', [RefereeDataController::class, 'submitSupportInfo'])->name('support-form.submit');
    Route::post('/risk-assessment/submit', [RefereeDataController::class, 'submitRiskAssessment'])->name('risk-assessment-form.submit');
    Route::post('/consent/submit', [RefereeDataController::class, 'submitConsentForm'])->name('consent-form.submit');
    Route::delete('/delete/{refereeData}', [RefereeDataController::class, 'deleteReferee'])->name('referee.delete');
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

// Payment routes
Route::group(['middleware' => ['auth', 'verified'], 'as' => 'invoice.'], function () {
    Route::get('invoices/{invoice}/checkout', [CheckoutController::class, 'show'])->name('checkout.page');
    Route::post('invoices/{invoice}/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('invoices/{invoice}/cancel', [CheckoutController::class, 'cancelPayment'])->name('cancel');
});
