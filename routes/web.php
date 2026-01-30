<?php

use App\Http\Controllers\Body\DashboardController;
use App\Http\Controllers\Body\inviteController;
use App\Http\Controllers\Body\urlGeneratorController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Route::view('/register', 'auth.register');
Route::get('/register', [LoginController::class, 'create'])->name('register.form');
Route::post('/register', [LoginController::class, 'store'])->name('register.store');
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/reset-password/{id}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::put('/reset-password/{id}', [LoginController::class, 'update'])->name('password.update');

Route::get('/forgot-password', [LoginController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'verifyEmail'])->name('password.verify');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('super_admin.dashboard');
    Route::get('/client_admin/dashboard', [DashboardController::class, 'clientindex'])
        ->name('client_admin.dashboard');
    Route::get('/member/dashboard', [DashboardController::class, 'memberindex'])
        ->name('member.dashboard');
    Route::get('/dashboard_filter', [DashboardController::class, 'filter'])
        ->name('super_admin.dashboard_filter');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export', [DashboardController::class, 'export'])->name('dashboard.export');
    Route::get('/member/dashboard/export', [DashboardController::class, 'memberCsvExport'])->name('member.export');
    Route::get('/invite', [inviteController::class, 'index'])->name('invite.index');
    Route::post('/invite/send', [inviteController::class, 'store'])->name('invite.send');
    Route::get('/invite_member', [inviteController::class, 'getMember'])->name('inviteMember.index');
    Route::post('/invite_member/send', [inviteController::class, 'createMember'])->name('inviteMember.send');
    Route::get('/roles', [inviteController::class, 'roleList'])
        ->name('roles.list');
    Route::get('/{code}', [inviteController::class, 'redirect']);
    Route::get('/client_admin/viewData', [DashboardController::class, 'getClient'])->name('client_admin.datadashboard');
    Route::get('/super_admin/viewData', [DashboardController::class, 'superClientData'])->name('super_admin.clientdashboard');
    Route::get('/client_admin/urlData', [DashboardController::class, 'urlData'])->name('client_admin.urlAllData');
    Route::get('/super_admin/urlData', [DashboardController::class, 'superUrlData'])->name('super_admin.urlDashboard');



    Route::get('/member/dashboard/url_generator', [UrlGeneratorController::class, 'generate'])
        ->name('member.urlGenerator');
    Route::get('/client_admin/dashboard/url_generator', [UrlGeneratorController::class, 'urlGenerate'])
        ->name('client_admin.urlGenerator');

    Route::post('/url-store', [UrlGeneratorController::class, 'urlStore'])
        ->name('url.store');
    // Route::post('/url_index', [UrlGeneratorController::class, 'index'])
    //     ->name('url.index');



});
