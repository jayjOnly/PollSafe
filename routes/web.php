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
use App\Http\Controllers\voting\VotingPageController;
use App\Http\Controllers\voting\HistoryController;
use App\Http\Controllers\voting\VotingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [HomeController::class, 'show'])->name('home');
Route::get('/about-us', [AboutUsController::class, 'show'])->name('about-us');
Route::get('/faq', [FAQController::class, 'show'])->name('faq');
Route::get('/votingPage', [VotingPageController::class, 'show'])->name('voting.show');
Route::get('/votingPage', [VotingPageController::class, 'index'])->name('voting.index');
Route::post('/votingPage', [VotingPageController::class, 'vote'])->name('voting.vote');
Route::get('/active', [VotingController::class, 'show'])->name('active');
Route::get('/history', [HistoryController::class, 'show'])->name('history');


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::get('/register', [RegisterController::class, 'show'])->name('register');

    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware(['auth', 'share_user'])->group(function () {
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/organization', [OrganizationController::class, 'show'])->name('organization');
    Route::get('/organization-detail/{organization_id}', [OrganizationDetailController::class, 'show'])->whereUuid('organization_id')->name('organization-detail');

    Route::post('/api/addOrganization', [OrganizationActionController::class, 'addOrganization']);
    Route::put('/api/editOrganization', [OrganizationActionController::class, 'editOrganization']);
    Route::delete('/api/deleteOrganization', [OrganizationActionController::class, 'deleteOrganization']);
});