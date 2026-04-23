<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VolunteerRequest;

class VolunteerRequestController extends Controller
{
    public function create()
    {
        $organization = auth()->user()->organization;
        return view('organization.createVolunteerRequest', compact('organization'));
    }

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

        dd($request->hasFile('image'), $request->file('image'));
    }
}