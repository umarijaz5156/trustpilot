<?php

use App\Livewire\Admin\Business\ClaimRequests;
use App\Livewire\Admin\Contact;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\ManageBusinessAccounts;
use App\Livewire\Admin\ManageVerificationMethods;
use App\Livewire\Admin\Settings\FeatureBusiness;
use App\Livewire\Admin\Settings\TagSetting;
use App\Livewire\BusinessOwner\Dispute\Index as DisputeIndex;

use App\Livewire\Admin\ManageCategories;
use App\Livewire\Admin\ManageDispute;
use App\Livewire\Admin\ManageReviews;
use App\Livewire\Admin\ManageSetting;
use App\Livewire\Admin\ManageUser;
use App\Livewire\Admin\SpamPharases;
use App\Livewire\Admin\ViewBusinessAccount;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
// });

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('dashboard/', Dashboard::class)->name('dashboard');
    Route::get('categories/', ManageCategories::class)->name('categories');
    Route::get('business/profiles', ManageBusinessAccounts::class)->name('business-accounts');
    Route::get('verification-methods', ManageVerificationMethods::class)->name('verification-methods');
    Route::get('business/view/{business_name}', ViewBusinessAccount::class)->name('view-business-account');
    Route::get('spam-pharases', SpamPharases::class)->name('spam-pharases');
    Route::get('dispute-requests', ManageDispute::class)->name('dispute-requests');
    Route::get('currencies', App\Livewire\Admin\Currencies::class)->name('currencies');
    Route::get('settings', App\Livewire\Admin\Settings\Index::class)->name('settings');
    Route::get('/users', ManageUser::class)->name('users');
    Route::get('/business/claim-requests', ClaimRequests::class)->name('business.claim-requests');
    Route::get('/reviews', ManageReviews::class)->name('reviews');
    Route::get('/disputes/{id?}', DisputeIndex::class)->name('disputes');
    Route::get('/contacts', Contact::class)->name('contacts');
    Route::get('/feature/business', FeatureBusiness::class)->name('feature.business');
    Route::get('/tags', TagSetting::class)->name('tags');


});
