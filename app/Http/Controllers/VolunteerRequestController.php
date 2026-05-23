<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VolunteerRequest;
use App\Models\VolunteerRegistration;

class VolunteerRequestController extends Controller
{
    /**
     * Menampilkan form pembuatan volunteer request
     */
    public function create()
    {
        $organization = auth()->user()->organization;

        return view('organization.createVolunteerRequest', compact('organization'));
    }

    /**
     * Menyimpan volunteer request baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'organization_id'   => 'required|exists:organizations,id',
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'task_description'  => 'required|string',
            'required_skills'   => 'nullable|string',
            'volunteer_quota'   => 'required|integer|min:1',
            'deadline'          => 'required|date|after_or_equal:today',
            'event_date'        => 'required|date|after_or_equal:deadline',
            'event_type'        => 'required|in:online,offline,hybrid',
            'location'          => 'required|string|max:255',
            'location_radius'   => 'nullable|numeric|min:0',
            'notes'             => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('volunteer-images', 'public');
        }

        VolunteerRequest::create([
            'organization_id'   => $request->organization_id,
            'title'             => $request->title,
            'description'       => $request->description,
            'task_description'  => $request->task_description,
            'required_skills'   => $request->required_skills,
            'volunteer_quota'   => $request->volunteer_quota,
            'deadline'          => $request->deadline,
            'event_date'        => $request->event_date,
            'event_type'        => $request->event_type,
            'location'          => $request->location,
            'location_radius'   => $request->location_radius,
            'notes'             => $request->notes,
            'image'             => $imagePath,
        ]);

        return redirect()
            ->route('organization.dashboard')
            ->with('success', 'Volunteer request berhasil dibuat.');
    }

    /**
     * Menampilkan form pendaftaran volunteer
     */
    public function showRegisterForm($id)
    {
        $volunteer = VolunteerRequest::findOrFail($id);

        return view('user.volunteer-register-form', compact('volunteer'));
    }

    /**
     * Menyimpan pendaftaran volunteer
     */
    public function storeRegistration(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cv'    => 'required|file|mimes:pdf|max:2048',
        ], [
            'cv.required' => 'File CV wajib diunggah.',
            'cv.mimes'    => 'Format file harus berupa PDF.',
            'cv.max'      => 'Ukuran file CV maksimal adalah 2MB.',
        ]);

        $volunteer = VolunteerRequest::findOrFail($id);

        $cvPath = null;

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv_volunteers', 'public');
        }

        VolunteerRegistration::create([
            'volunteer_id' => $volunteer->id,
            'name'         => $request->name,
            'email'        => $request->email,
            'cv_path'      => $cvPath,
        ]);

        return redirect()
            ->route('user.explore.volunteer', $volunteer->id)
            ->with('success', 'Pendaftaran volunteer berhasil dikirim!');
    }

    public function cancelRegistration($id)
    {
        VolunteerRegistration::where('volunteer_id', $id)->delete();

        return redirect()
            ->back()
            ->with('success', 'Pendaftaran volunteer berhasil dibatalkan.');
    }
}
