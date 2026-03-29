<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\OrgController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

//Autentikasi User
Route::get('/register', [AuthUserController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthUserController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthUserController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthUserController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthUserController::class, 'logout'])->name('logout');

//Registrasi Organisasi
Route::get('/register/organization', [OrgController::class, 'showRegisterOrganization'])->name('organization.register');
Route::post('/register/organization', [OrgController::class, 'registerOrganization'])->name('organization.register.submit');


//Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    //Verifikasi Organisasi
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'role:admin']);
    Route::get('/admin/organizations', [AdminController::class, 'pendingOrganizations'])->name('admin.organizations.pending');
    Route::get('/admin/organizations/{id}', [AdminController::class, 'show'])->name('admin.organizations.show');
    Route::post('/admin/organizations/{id}/approve', [AdminController::class, 'approve'])->name('admin.organizations.approve');
    Route::post('/admin/organizations/{id}/reject', [AdminController::class, 'reject'])->name('admin.organizations.reject');
});

// Organization Routes
Route::middleware(['auth', 'role:organization'])->group(function () {
    Route::get('/organization/dashboard', [OrgController::class, 'dashboard'])->name('organization.dashboard');
});