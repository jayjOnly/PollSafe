<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\OrganizationMemberController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/organizations/create', [OrganizationsController::class, 'create'])->name('organizations.create');
Route::post('/organizations', [OrganizationsController::class, 'store'])->name('organizations.store');
Route::get('/organizations/{organization:uuid}', [OrganizationsController::class, 'show'])->name('organizations.show');
Route::get('/organizations/{organization:uuid}/edit', [OrganizationsController::class, 'edit'])->name('organizations.edit');
Route::get('/organizations/{organization:uuid}/manage', [OrganizationsController::class, 'manage'])->name('organizations.manage');
Route::get('/organizations', [OrganizationsController::class, 'index'])->name('organizations.index');
Route::put('/organizations/{organization:uuid}', [OrganizationsController::class, 'update'])->name('organizations.update');

Route::middleware(['auth'])->group(function () {
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

