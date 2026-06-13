<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VolunteerRegistration;
use App\Models\DonationSubmission;
use App\Models\VolunteerReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserPoints;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // DASHBOARD
   public function dashboard()
    {
        $user = auth()->user();

        $donations = DonationSubmission::where('user_id', $user->id)
            ->latest()
            ->get();

        $points = UserPoints::firstOrCreate(
            ['user_id' => $user->id],
            [
                'total_points' => 0,
                'used_points' => 0,
                'available_points' => 0,
            ]
        );

        return view('user.dashboard', compact(
            'user',
            'donations',
            'points'
        ));
    }

    // UPDATE PROFILE
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone'   => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile berhasil diupdate');
    }

    // UPLOAD FOTO PROFILE
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user = Auth::user();

        if (!empty($user->profile_photo) && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $path = $request->file('profile_photo')->store('profile', 'public');

        $user->update([
            'profile_photo' => $path,
        ]);

        return back()->with('success', 'Foto berhasil diupload');
    }

    public function publicProfile($id)
    {
        $user = User::findOrFail($id);
        $blogs = \App\Models\Blog::where('user_id', $user->id)->latest()->get();


        return view('user.public-profile', compact('user'
        , 'blogs'));
    }

    public function historyKegiatan()
    {
        $user = auth()->user();

        $volunteers = VolunteerRegistration::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        $donations = DonationSubmission::where(
            'user_id',
            $user->id
        )->latest()->get();

        return view(
            'user.historyKegiatan',
            compact('volunteers', 'donations')
        );
    }

    public function showVolunteerReview($id)
    {
        $volunteer = VolunteerRegistration::findOrFail($id);

        // CEK APAKAH USER SUDAH REVIEW
        $existingReview = VolunteerReview::where(
            'user_id',
            auth()->id()
        )
        ->where(
            'volunteer_registration_id',
            $volunteer->id
        )
        ->first();

        return view(
            'user.volunteerReview',
            compact(
                'volunteer',
                'existingReview'
            )
        );
    }

    public function submitVolunteerReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        $volunteer = VolunteerRegistration::findOrFail($id);

        // KALO SUDAH ADA = UPDATE
        // KALO BELUM ADA = CREATE
        VolunteerReview::updateOrCreate(

            // kondisi pencarian
            [
                'user_id' => auth()->id(),

                'volunteer_registration_id' => $volunteer->id,
            ],

            // data yang diupdate / dibuat
            [
                'volunteer_request_id' => $volunteer->volunteer_id,

                'rating' => $request->rating,

                'review' => $request->review,
            ]

        );

        return redirect()
            ->route('user.history.kegiatan')
            ->with('success', 'Review berhasil disimpan!');
    }
}