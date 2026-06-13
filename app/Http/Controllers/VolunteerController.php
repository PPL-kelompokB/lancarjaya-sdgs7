<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VolunteerRequest;
use App\Models\VolunteerRegistration;
use App\Models\UserPoints;

class VolunteerController extends Controller
{
    /**
     * Menampilkan Form Pendaftaran
     */
    public function showRegisterForm($id)
    {
        $volunteer = VolunteerRequest::findOrFail($id);

        return view('user.volunteer-register-form', compact('volunteer'));
    }

    /**
     * Simpan Pendaftaran Volunteer
     */
    public function storeRegistration(Request $request, $id)
    {
        $volunteer = VolunteerRequest::findOrFail($id);

        $existing = VolunteerRegistration::where('user_id', auth()->id())
            ->where('volunteer_id', $volunteer->id)
            ->exists();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'Anda sudah terdaftar pada volunteer ini.');
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cv'    => 'required|file|mimes:pdf|max:2048',
        ]);

        $cvPath = null;

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv_volunteers', 'public');
        }

        VolunteerRegistration::create([
            'user_id'      => auth()->id(),
            'volunteer_id' => $volunteer->id,
            'name'         => $request->name,
            'email'        => $request->email,
            'cv_path'      => $cvPath,
            'status'       => 'in_review',
            'notes'        => null,
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Pendaftaran volunteer berhasil dikirim.');
    }

    public function showApplicants($id)
    {
        $volunteer = VolunteerRequest::findOrFail($id);

        $applicants = VolunteerRegistration::where(
            'volunteer_id',
            $id
        )->latest()->get();

        return view(
            'organization.volunteerApplicants',
            compact('volunteer', 'applicants')
        );
    }

    public function updateApplicantStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'notes'  => 'nullable|string',
        ]);

        $applicant = VolunteerRegistration::findOrFail($id);

        $oldStatus = $applicant->status;

        $applicant->update([
            'status' => $request->status,
            'notes'  => $request->notes,
        ]);

        // Give points only when changing to Done
        if ($oldStatus !== 'done' && $request->status === 'done') {

            UserPoints::addPoints(
                $applicant->user_id,
                150
            );
        }

        return redirect()->back()->with(
            'success',
            'Status volunteer berhasil diperbarui.'
        );
    }

    public function complete($id)
    {
        $volunteer = VolunteerRequest::findOrFail($id);

        $volunteer->status = 'completed';
        $volunteer->save();

        $participants = VolunteerRegistration::where(
            'volunteer_id',
            $volunteer->id
        )
        ->where('status', 'accepted')
        ->get();

        foreach ($participants as $participant) {

            $participant->status = 'done';
            $participant->save();

            UserPoints::addPoints(
                $participant->user_id,
                100
            );
        }

        return back()->with(
            'success',
            'Volunteer selesai.'
        );
    }

    public function show($id)
    {
        $volunteer = VolunteerRequest::findOrFail($id);

        $alreadyRegistered = VolunteerRegistration::where(
            'user_id',
            auth()->id()
        )
        ->where(
            'volunteer_id',
            $volunteer->id
        )
        ->exists();

        return view(
            'user.explore-detail-volunteer',
            compact('volunteer', 'alreadyRegistered')
        );
    }

    public function cancel($id)
    {
        VolunteerRegistration::where('user_id', auth()->id())
            ->where('volunteer_id', $id)
            ->delete();

        return redirect()->back()->with(
            'success',
            'Pendaftaran volunteer berhasil dibatalkan.'
        );
    }

    public function edit($id)
    {
        $volunteer = VolunteerRequest::where(
            'organization_id',
            auth()->user()->organization->id
        )->findOrFail($id);

        return view('organization.volunteerEdit', compact('volunteer'));
    }

    public function update(Request $request, $id)
    {
        $volunteer = VolunteerRequest::where(
            'organization_id',
            auth()->user()->organization->id
        )->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'task_description' => 'required|string',
            'required_skills' => 'nullable|string',
            'volunteer_quota' => 'required|integer|min:1',
            'deadline' => 'required|date',
            'event_date' => 'required|date',
            'event_type' => 'required|in:online,offline,hybrid',
            'location' => 'required|string|max:255',
            'location_radius' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('volunteers', 'public');
        }

        $volunteer->update($validated);

        return redirect()
            ->route('organization.dashboard')
            ->with(
                'success',
                'Volunteer request berhasil diperbarui.'
            );
    }
}
