<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Models\VolunteerRegistration; // Pastikan model ini sudah ada
use Illuminate\Support\Facades\Storage;

class VolunteerController extends Controller
{
    /**
     * Menampilkan Form Pendaftaran
     */
    public function showRegisterForm($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        return view('volunteer-register-form', compact('volunteer'));
    }

    /**
     * Memproses Data Form dan Menyimpan File CV
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

        $volunteer = Volunteer::findOrFail($id);

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

        return redirect()->back()->with('success', 'Pendaftaran Anda berhasil dikirim!');
    }
}