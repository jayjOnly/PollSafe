<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\OrganizationMemberController;

Route::fallback(function () {
    return redirect('/');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/organizations/create', [OrganizationsController::class, 'create'])
        ->name('organizations.create');
    Route::post('/organizations', [OrganizationsController::class, 'store'])
        ->name('organizations.store');
    Route::get('/organizations/{organization:uuid}', [OrganizationsController::class, 'show'])
        ->name('organizations.show');
    Route::get('/organizations/{organization:uuid}/edit', [OrganizationsController::class, 'edit'])
        ->name('organizations.edit');
    Route::get('/organizations/{organization:uuid}/manage', [OrganizationsController::class, 'manage'])
        ->name('organizations.manage');
    Route::get('/organizations', [OrganizationsController::class, 'index'])
        ->name('organizations.index');
    Route::put('/organizations/{organization:uuid}', [OrganizationsController::class, 'update'])
        ->name('organizations.update');
    Route::get('/organizations/{organization}/members', [OrganizationMemberController::class, 'index'])
        ->name('organizations.members.index');
    Route::post('/organizations/{organization}/members/invite', [OrganizationMemberController::class, 'invite'])
        ->name('organizations.members.invite');
    Route::put('/organizations/{organization}/members/{member}/role', [OrganizationMemberController::class, 'updateRole'])
        ->name('organizations.members.updateRole');
    Route::delete('/organizations/{organization}/members/{member}', [OrganizationMemberController::class, 'remove'])
        ->name('organizations.members.remove');
});

Route::get('/about-us', function () {
    return view('aboutus');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/test-page', function () {
    return view('test-page');
});

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1'); // Batasi 5 request per menit
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1'); // Batasi 5 request per menit
});

Route::middleware('auth')->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

