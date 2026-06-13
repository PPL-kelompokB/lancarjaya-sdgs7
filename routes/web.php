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
use App\Http\Controllers\MonitoringController;
use App\Models\Organization;
use App\Models\DonationSubmission;
use Illuminate\Http\Request;
use App\Models\Donation;
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

    Route::get('/admin/monitoring', [MonitoringController::class, 'index'])
        ->name('admin.monitoring.index');
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

    Route::put(
        '/submission/{submissionId}/status',
        [DonationController::class, 'updateStatus']
    )->name('submission.updateStatus');

    Route::get(
        '/volunteer/{id}/applicants',
        [VolunteerController::class, 'showApplicants']
    )->name('organization.volunteer.applicants');

    Route::put(
        '/volunteer/applicant/{id}/status',
        [VolunteerController::class, 'updateApplicantStatus']
    )->name('organization.volunteer.update.status');

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

    Route::post(
        '/volunteer/{id}/register',
        [VolunteerController::class, 'storeRegistration']
    )->name('volunteer.register.submit');

    Route::get(
        '/history-kegiatan',
        [UserController::class, 'historyKegiatan']
    )->name('user.history.kegiatan');

    Route::get(
        '/volunteer/{id}/review',
        [UserController::class, 'showVolunteerReview']
    )->name('user.volunteer.review');

    Route::post(
        '/volunteer/{id}/review',
        [UserController::class, 'submitVolunteerReview']
    )->name('user.volunteer.review.submit');

});
// Route untuk membuka halaman form pendaftaran
Route::get('/volunteer/{id}/register', [VolunteerController::class, 'showRegisterForm'])->name('volunteer.register');

// Route untuk submit form dan CV (untuk tahap selanjutnya)
Route::post('/volunteer/{id}/register', [VolunteerController::class, 'storeRegistration'])->name('volunteer.register.submit');

Route::get(
    '/organization/donation/{id}',
    [DonationController::class, 'organizationDetail']
)->name('organization.donation.detail');

Route::get('/donation/form/{id}', function ($id) {

    $donation = Donation::findOrFail($id);

    return view('user.donate-form', compact('donation'));

})->name('donation.form');

Route::post('/donation/submit/{id}', function (Request $request, $id) {

    $request->validate([
        'item_name' => 'required',
        'quantity' => 'required',
        'unit' => 'required',
        'pickup_address' => 'required',
        'phone_number' => 'required',
        'pickup_date' => 'required',
    ]);

    $imagePath = null;

    if ($request->hasFile('pickup_proof_image')) {

        $imagePath = $request->file('pickup_proof_image')
            ->store('donation_proofs', 'public');
    }

    DonationSubmission::create([

        'donation_id' => $id,

        'user_id' => auth()->id(),

        'item_name' => $request->item_name,

        'quantity' => $request->quantity,

        'unit' => $request->unit,

        'pickup_address' => $request->pickup_address,

        'phone_number' => $request->phone_number,

        'pickup_date' => $request->pickup_date,

        'notes' => $request->notes,

        'pickup_proof_image' => $imagePath,

        'status' => 'pending',
    ]);

    return redirect()
        ->route('user.dashboard')
        ->with('success', 'Donation submitted successfully!');

})->name('donation.submit');


Route::prefix('organization')
    ->middleware(['auth', 'role:organization'])
    ->group(function () {

        // DETAIL APPLICANTS
        Route::get(
            '/volunteer/{id}/applicants',
            [VolunteerController::class, 'showApplicants']
        )->name('organization.volunteer.applicants');

        // UPDATE STATUS
        Route::put(
            '/volunteer/applicant/{id}/status',
            [VolunteerController::class, 'updateApplicantStatus']
        )->name('organization.volunteer.update.status');

});

Route::patch(
    '/donations/{id}/finish',
    [DonationController::class, 'finish']
)->name('donations.finish');

Route::patch(
    '/volunteer/{id}/complete',
    [VolunteerRequestController::class, 'complete']
)->name('volunteer.complete');

Route::get('/donation/{id}', [DonationController::class, 'show'])
    ->name('user.donation.detail');

Route::get('/volunteer/{id}', [VolunteerController::class, 'show'])
    ->name('user.volunteer.detail');

Route::post('/voucher/{voucher}/redeem',
    [VoucherController::class, 'redeem'])
    ->name('user.voucher.redeem');

Route::delete(
    '/volunteer/{id}/cancel',
    [VolunteerController::class, 'cancel']
    )->name('volunteer.cancel');

Route::get(
    '/organization/volunteer/{id}/edit',
    [VolunteerController::class, 'edit']
)->name('organization.volunteer.edit');

Route::put(
    '/organization/volunteer/{id}',
    [VolunteerController::class, 'update']
)->name('organization.volunteer.update');
