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

        return view('volunteer-register-form', compact('volunteer'));
    }

    /**
     * Simpan Pendaftaran Volunteer
     */
    public function storeRegistration(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cv'    => 'required|file|mimes:pdf|max:2048',
        ]);

        $volunteer = VolunteerRequest::findOrFail($id);

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

        return redirect()
            ->back()
            ->with('success', 'Pendaftaran berhasil dikirim!');
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

        $applicant->update([
            'status' => $request->status,
            'notes'  => $request->notes,
        ]);

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

        return view('user.explore-detail-volunteer', compact('volunteer'));
    }
}