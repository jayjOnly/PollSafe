<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\onboarding\HomeController;
use App\Http\Controllers\onboarding\AboutUsController;
use App\Http\Controllers\onboarding\FAQController;
use App\Http\Controllers\organization\OrganizationActionController;
use App\Http\Controllers\organization\OrganizationController;
use App\Http\Controllers\organization\OrganizationDetailController;
use App\Http\Controllers\organization\OrganizationMemberActionController;
use App\Http\Controllers\voting\CreateController;
use App\Http\Controllers\voting\VotingPageController;
use App\Http\Controllers\voting\HistoryController;
use App\Http\Controllers\voting\VoteActionController;
use App\Http\Controllers\voting\VotingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::fallback(function () {
    abort(404);
});

Route::get('/home', [HomeController::class, 'show'])->name('home');
Route::get('/about-us', [AboutUsController::class, 'show'])->name('about-us');
Route::get('/faq', [FAQController::class, 'show'])->name('faq');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::get('/register', [RegisterController::class, 'show'])->name('register');

    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,2');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('throttle:5,2');
});

Route::middleware(['auth', 'share_user'])->group(function () {
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/organization', [OrganizationController::class, 'show'])->name('organization');
    Route::get('/organization-detail/{organization_id}', [OrganizationDetailController::class, 'show'])->whereUuid('organization_id')->name('organization-detail');

    Route::get('/organization-voting-create/{organization_id}', [CreateController::class, 'show'])->whereUuid('organization_id')->name('voting-create');
    Route::get('/organization-voting-active/{organization_id}', [VotingController::class, 'show'])->whereUuid('organization_id')->name('voting-active');
    Route::get('/organization-voting-history/{organization_id}', [HistoryController::class, 'show'])->whereUuid('organization_id')->name('voting-history');
    Route::get('/organization-voting/{organization_vote_id}', [VotingPageController::class, 'show'])->whereUuid('organization_vote_id')->name('voting');

    Route::post('/api/addOrganization', [OrganizationActionController::class, 'addOrganization']);
    Route::put('/api/editOrganization', [OrganizationActionController::class, 'editOrganization']);
    Route::delete('/api/deleteOrganization', [OrganizationActionController::class, 'deleteOrganization']);

    Route::post('/api/addOrganizationMember', [OrganizationMemberActionController::class, 'addOrganizationMember']);
    Route::delete('/api/deleteOrganizationMember', [OrganizationMemberActionController::class, 'deleteOrganizationMember']);

    Route::post('/api/addVote', [VoteActionController::class, 'addVote']);
    Route::post('/api/setVote', [VoteActionController::class, 'setVote']);
});