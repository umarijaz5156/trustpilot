<?php

use App\Http\Controllers\SetupController;
use App\Livewire\BusinessOwner\Dashboard;
use App\Livewire\BusinessOwner\Details;
use App\Livewire\BusinessOwner\Dispute\Index as DisputeIndex;
use App\Livewire\BusinessOwner\Tickets;
use App\Livewire\BusinessOwner\WidgetComponent;
use App\Livewire\Front\Categories\Business;
use App\Livewire\Front\Home;
use App\Livewire\Front\ViewBusiness;
use App\Livewire\User\BusinessAccount;
use App\Livewire\User\ContactUs;
use App\Livewire\VerifyEmail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$installed = Storage::disk('public')->exists('installed');

if ($installed === false) {
    Route::get('/setup', App\Livewire\Setup\Check::class)->name('setup.check');
    Route::post('/setup/last-step', [SetupController::class, 'lastStep'])->name('setup.last-step');
}



Route::get('/', Home::class)->name('home')->middleware('isVerified');


Route::get('/setup/finish', function () {
    $redirect = route('home');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return view('setup-complete', compact('redirect'));
})->name('setup.finish');


Route::middleware(['isVerified'])->group(function () {


Route::group(['prefix' => 'categories'], function () {
    Route::get('/', App\Livewire\Front\Categories\Index::class)->name('categories.show.all');
    Route::get('/{category}', Business::class)->name('categories.business');
  
    
});

Route::group(['middleware' => ['auth', 'web']], function () {

    Route::get('/business-account/create', BusinessAccount::class)->name('business-account.create');

    Route::group(['prefix' => 'business', 'middleware' => ['user.business_owner']], function () {
        // Dashboard
        Route::get('/dashboard', Dashboard::class)->name('business-owner.dashboard');
        Route::get('/business-and-verification-details', Details::class)->name('business-owner.details');
        Route::get('/tickets', Tickets::class)->name('business-owner.tickets');
        Route::get('/disputes', DisputeIndex::class)->name('business-owner.disputes');
        Route::get('/profile/edit', function () {
            return view('profile.show-owner');
        })->name('business-owner.profile.edit');

        Route::get('/disputes/{id?}', DisputeIndex::class)->name('business-owner.disputes');
        Route::get('/dynamic-widget', WidgetComponent::class)->name('business-owner.dynamicWidget');

    });
});

Route::get('/business/{business_name}', App\Livewire\Front\ReviewBusiness::class)->name('front.business.show');

// normal dispute
Route::get('/disputes/{id?}', App\Livewire\Dispute\Index::class)->name('disputes');

});

Route::get('/logout-user', function () {
    Auth::logout();
    return redirect('/');
})->name('logout-user');


Route::get('/privacy-policy', function(){
    return view('policy');
})->name('privacy-policy');

Route::get('/terms-and-conditions', function(){
    return view('terms');
})->name('terms');

Route::get('/cookies-policy', function(){
    return view('cookies');
})->name('cookies');

  Route::get('/contact-us', ContactUs::class)->name('contactUs');
  
  Route::get('/verification-email', VerifyEmail::class)->name('verification.notice');

  