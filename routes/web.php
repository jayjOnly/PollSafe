<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\onboarding\HomeController;
use App\Http\Controllers\onboarding\AboutUsController;
use App\Http\Controllers\onboarding\FAQController;
use App\Http\Controllers\organization\OrganizationController;
use App\Http\Controllers\organization\OrganizationActionController;
use App\Http\Controllers\organization\OrganizationMemberActionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [HomeController::class, 'show'])->name('home');
Route::get('/about-us', [AboutUsController::class, 'show'])->name('about-us');
Route::get('/faq', [FAQController::class, 'show'])->name('faq');

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
    Route::get('/organization1', [OrganizationActionController::class, 'addOrganization'])->name('addorganization');
    Route::get('/organization2', [OrganizationActionController::class, 'editOrganization'])->name('editorganization');
    Route::get('/organization3', [OrganizationActionController::class, 'deleteOrganization'])->name('deleteorganization');
    Route::get('/organization4', [OrganizationMemberActionController::class, 'addOrganizationMember'])->name('addorganizationmember');
    Route::get('/organization5', [OrganizationMemberActionController::class, 'deleteOrganizationMember'])->name('deleteorganizationmember');
    Route::get('/organization6', [OrganizationMemberActionController::class, 'changeOrganizationMemberRole'])->name('changeorganizationmemberrole');
});