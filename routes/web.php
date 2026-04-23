<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\OrgController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Organization;

Route::get('/', function () {
    return view('landing-page');
})->name('landing-page');

// Profil publik organisasi (bisa diakses tanpa login, tapi follow butuh login)
Route::get('/organizations/{organization}', [FollowController::class, 'publicProfile'])->name('organization.public-profile');

// Autentikasi User
Route::get('/register', [AuthUserController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthUserController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthUserController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthUserController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthUserController::class, 'logout'])->name('logout');

// Registrasi Organisasi
Route::get('/register/organization', [OrgController::class, 'showRegisterOrganization'])->name('organization.register');
Route::post('/register/organization', [OrgController::class, 'registerOrganization'])->name('organization.register.submit');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/organizations/{id}', [AdminController::class, 'showOrganization'])->name('admin.organizations.show');
    Route::post('/admin/organizations/{id}/approve', [AdminController::class, 'approve'])->name('admin.organizations.approve');
    Route::post('/admin/organizations/{id}/reject', [AdminController::class, 'reject'])->name('admin.organizations.reject');
    Route::get('/admin/organizations', [AdminController::class, 'organizations'])->name('admin.organizations.index');

    Route::get('/admin/vouchers', [VoucherController::class, 'index'])->name('admin.vouchers.index');
    Route::get('/admin/vouchers/create', [VoucherController::class, 'create'])->name('admin.vouchers.create');
    Route::post('/admin/vouchers', [VoucherController::class, 'store'])->name('admin.vouchers.store');
    Route::get('/admin/vouchers/{id}/edit', [VoucherController::class, 'edit'])->name('admin.vouchers.edit');
    Route::put('/admin/vouchers/{id}', [VoucherController::class, 'update'])->name('admin.vouchers.update');
    Route::delete('/admin/vouchers/{id}', [VoucherController::class, 'destroy'])->name('admin.vouchers.destroy');
});

Route::middleware(['auth'])->group(function () {

    // 🔍 SEARCH (semua user login bisa akses)
    Route::get('/search', [SearchController::class, 'globalSearch'])->name('search.global');
    Route::get('/search/blogs', [SearchController::class, 'searchBlogs'])->name('search.blogs');
    Route::get('/search/organizations', [SearchController::class, 'searchOrganizations'])->name('search.organizations');

    // ⭐ FOLLOW ORGANISASI (A-07)
    Route::post('/organizations/{organization}/follow', [FollowController::class, 'toggle'])->name('organization.follow.toggle');
    Route::get('/feed', [FollowController::class, 'feed'])->name('user.feed');

    // 👤 USER DASHBOARD & PROFILE
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::put('/user/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/user/profile-photo', [UserController::class, 'updatePhoto'])->name('user.profile.photo.update');

});

// Organization Routes
Route::middleware(['auth', 'role:organization'])->group(function () {
    Route::get('/organization/dashboard', [OrgController::class, 'dashboard'])->name('organization.dashboard');

    Route::put('/organization/profile', [OrgController::class, 'updateProfile'])
        ->name('organization.profile.update');

    Route::post('/organization/profile-image', [OrgController::class, 'updateProfileImage'])
        ->name('organization.profile-image.update');

    Route::post('/organization/cover-image', [OrgController::class, 'updateCoverImage'])
        ->name('organization.cover-image.update');

    Route::get('/organization/{id}/create-blog', function ($id) {
        $organization = Organization::findOrFail($id);
        return view('organization.createBlog', compact('organization'));
    })->name('organization.blog.create');

    Route::post('/organization/blog', [BlogController::class, 'store'])
        ->name('organization.blog.store');
});