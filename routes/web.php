<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\OrgController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('landing-page');
})->name('landing-page');
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
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/organizations/{id}', [AdminController::class, 'showOrganization'])
        ->name('admin.organizations.show');

    Route::post('/admin/organizations/{id}/approve', [AdminController::class, 'approve'])
        ->name('admin.organizations.approve');

    Route::post('/admin/organizations/{id}/reject', [AdminController::class, 'reject'])
        ->name('admin.organizations.reject');
    
    Route::get('/admin/organizations', [AdminController::class, 'organizations'])
        ->name('admin.organizations.index');

    // Voucher Management
    Route::get('/admin/vouchers', [VoucherController::class, 'index'])->name('admin.vouchers.index');
    Route::get('/admin/vouchers/create', [VoucherController::class, 'create'])->name('admin.vouchers.create');
    Route::post('/admin/vouchers', [VoucherController::class, 'store'])->name('admin.vouchers.store');
    Route::get('/admin/vouchers/{id}/edit', [VoucherController::class, 'edit'])->name('admin.vouchers.edit');
    Route::put('/admin/vouchers/{id}', [VoucherController::class, 'update'])->name('admin.vouchers.update');
    Route::delete('/admin/vouchers/{id}', [VoucherController::class, 'destroy'])->name('admin.vouchers.destroy');
});


// Organization Routes
Route::middleware(['auth', 'role:organization'])->group(function () {
    Route::get('/organization/dashboard', [OrgController::class, 'dashboard'])->name('organization.dashboard');
    //Edit Profile Organisasi
    Route::put('/organization/profile', [OrgController::class, 'updateProfile'])
    ->name('organization.profile.update');
    Route::post('/organization/profile-image', [OrgController::class, 'updateProfileImage'])
        ->name('organization.profile-image.update');
    Route::post('/organization/cover-image', [OrgController::class, 'updateCoverImage'])
        ->name('organization.cover-image.update');
    // 🔥 TAMBAH DI SINI
    Route::post('/organization/blog', [OrgController::class, 'storeBlog']);
});


// BLOG PENDONASI (ORGANIZATION)
Route::prefix('organization')->group(function () {

    // tampilkan semua blog
    Route::get('/blog', [OrgController::class, 'indexBlog'])->name('organization.blog.index');

    // form tambah blog
    Route::get('/blog/create', [OrgController::class, 'createBlog'])->name('organization.blog.create');

    // simpan blog
    Route::post('/blog', [OrgController::class, 'storeBlog'])->name('organization.blog.store');

    // form edit
    Route::get('/blog/{id}/edit', [OrgController::class, 'editBlog'])->name('organization.blog.edit');

    // update
    Route::put('/blog/{id}', [OrgController::class, 'updateBlog'])->name('organization.blog.update');

    // delete
    Route::delete('/blog/{id}', [OrgController::class, 'destroyBlog'])->name('organization.blog.delete');
});

use App\Http\Controllers\Pendonasi\PendonasiBlogController;

Route::prefix('pendonasi')->name('pendonasi.')->group(function () {

    Route::get('/blog', [PendonasiBlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/create', [PendonasiBlogController::class, 'create'])->name('blog.create');
    Route::post('/blog', [PendonasiBlogController::class, 'store'])->name('blog.store');

    Route::get('/blog/{id}', [PendonasiBlogController::class, 'show'])->name('blog.show');
    Route::get('/blog/{id}/edit', [PendonasiBlogController::class, 'edit'])->name('blog.edit');

    Route::put('/blog/{id}', [PendonasiBlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}', [PendonasiBlogController::class, 'destroy'])->name('blog.delete');

});