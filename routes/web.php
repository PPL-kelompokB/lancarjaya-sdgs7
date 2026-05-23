<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\OrgController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\UserVoucherController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VolunteerRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\UserExploreController;
use App\Http\Controllers\OrganizationFollowController;
use App\Http\Controllers\InteractionController;
use App\Models\Organization;
use App\Http\Controllers\EcoDonateRatingController;
use App\Http\Controllers\VolunteerController;

Route::get('/', function () {
    return view('landing-page');
})->name('landing-page');

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
    Route::get('/admin/monitoring', [AdminController::class, 'monitoring'])->name('admin.monitoring');
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
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::put('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/user/photo/update', [UserController::class, 'updatePhoto'])->name('user.photo.update');
    Route::get('/search', [SearchController::class, 'globalSearch'])->name('search.global');
    Route::get('/search/blogs', [SearchController::class, 'searchBlogs'])->name('search.blogs');
    Route::get('/search/organizations', [SearchController::class, 'searchOrganizations'])->name('search.organizations');
    Route::get('/organization/profile/{id}', [OrgController::class, 'publicProfile'])
    ->name('organization.public.profile');

    // 🔥 PROFIL USER (TAMBAH DI SINI)
    Route::get('/profil', [UserController::class, 'dashboard'])->name('user.profil');
    Route::put('/profil/update', [UserController::class, 'updateProfile'])->name('user.update');
    Route::post('/profil/photo', [UserController::class, 'updatePhoto'])->name('user.photo');

     // ✅ FOLLOW ORGANIZATION (TAMBAH DI SINI)
    Route::post('/organizations/{organization}/follow', [OrganizationFollowController::class, 'follow'])
        ->name('organizations.follow');

    Route::delete('/organizations/{organization}/unfollow', [OrganizationFollowController::class, 'unfollow'])
        ->name('organizations.unfollow');

    Route::get('/user/profile/{id}', [UserController::class, 'publicProfile'])
    ->name('user.public.profile');

    Route::post('/like/{type}/{id}', [InteractionController::class, 'like'])->name('like');
    Route::post('/comment/{type}/{id}', [InteractionController::class, 'comment'])->name('comment');
    Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');

    // 🎁 USER VOUCHER REDEMPTION (PENUKARAN POIN)
    Route::get('/user/vouchers', [UserVoucherController::class, 'index'])->name('user.voucher.index');
    Route::get('/user/vouchers/{voucherId}', [UserVoucherController::class, 'show'])->name('user.voucher.show');
    Route::post('/user/vouchers/{voucherId}/redeem', [UserVoucherController::class, 'redeem'])->name('user.voucher.redeem');
    Route::get('/user/vouchers/history/all', [UserVoucherController::class, 'history'])->name('user.voucher.history');
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

    Route::post('/organization/blog', [OrgController::class, 'storeBlog'])
        ->name('organization.blog.store');

    Route::get('/organization/donation/create', [DonationController::class, 'create'])
        ->name('organization.donation.create');

    Route::post('/organization/donation/store', [DonationController::class, 'store'])
        ->name('organization.donation.store');

    Route::get('/organization/donations/create', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/organization/donations', [DonationController::class, 'store'])->name('donations.store');

    Route::get('/organization/donations/{id}/edit', [DonationController::class, 'edit'])->name('donations.edit');
    Route::put('/organization/donations/{id}', [DonationController::class, 'update'])->name('donations.update');
    Route::delete('/organization/donations/{id}', [DonationController::class, 'destroy'])->name('donations.destroy');

    Route::get('/organization/blog/{id}/edit', [OrgController::class, 'editBlog'])
    ->name('organization.blog.edit');

    Route::put('/organization/blog/{id}', [OrgController::class, 'updateBlog'])
        ->name('organization.blog.update');

    Route::delete('/organization/blog/{id}', [OrgController::class, 'deleteBlog'])
        ->name('organization.blog.delete');


    Route::get('/organization/volunteer-request/create', [VolunteerRequestController::class, 'create'])
        ->name('organization.volunteer-request.create');

    Route::post('/organization/volunteer-request/store', [VolunteerRequestController::class, 'store'])
        ->name('organization.volunteer-request.store');

    Route::get('/organization/statistics', [OrgController::class, 'statistics'])
        ->name('organization.statistics');
});

Route::prefix('user')->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->name('user.dashboard');

    // INDEX BLOG
    Route::get('/blogs', [BlogController::class, 'index'])
        ->name('user.blog.index');

    // CREATE BLOG (FIX: sesuai file kamu)
    Route::get('/blog/create', function () {
        return view('user.createBlog');
    })->name('user.blog.create');

    // STORE BLOG
    Route::post('/blog/store', [BlogController::class, 'store'])
        ->name('user.blog.store');

    // EDIT BLOG
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])
        ->name('user.blog.edit');

    // UPDATE BLOG
    Route::put('/blog/update/{id}', [BlogController::class, 'update'])
        ->name('user.blog.update');

    // DELETE BLOG
    Route::delete('/blog/delete/{id}', [BlogController::class, 'destroy'])
        ->name('user.blog.delete');

});



Route::prefix('user')->group(function () {

    Route::get('/explore', [ExploreController::class, 'index'])
        ->name('user.explore');

    Route::get('/explore/blog/{id}', [ExploreController::class, 'detailBlog'])
        ->name('user.explore.blog');

    Route::get('/explore/donation/{id}', [ExploreController::class, 'detailDonation'])
        ->name('user.explore.donation');

    Route::get('/explore/volunteer/{id}', [ExploreController::class, 'detailVolunteer'])
        ->name('user.explore.volunteer');
});

// VOLUNTEER REQUEST ROUTES
Route::get('/volunteer/{id}/register', [VolunteerRequestController::class, 'showRegisterForm'])
    ->name('volunteer.register');

Route::post('/volunteer/{id}/register', [VolunteerRequestController::class, 'storeRegistration'])
    ->name('volunteer.register.submit');

Route::delete('/volunteer/{id}/cancel', [VolunteerRequestController::class, 'cancelRegistration'])
    ->name('volunteer.cancel');
