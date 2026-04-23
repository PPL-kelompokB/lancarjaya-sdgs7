<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function create()
    {
        $organization = auth()->user()->organization;

        return view('organization.createDonation', compact('organization'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'item_name'       => 'required|string',
            'category'        => 'nullable|string',
            'quantity'        => 'nullable|integer',
            'unit'            => 'nullable|string',
            'address'         => 'required|string',
            'city'            => 'required|string',
            'province'        => 'required|string',
            'contact_person'  => 'required|string',
            'contact_phone'   => 'required|string',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after_or_equal:start_date',
        ]);

        Donation::create([
            'organization_id' => $request->organization_id,
            'title'           => $request->title,
            'description'     => $request->description,
            'item_name'       => $request->item_name,
            'category'        => $request->category,
            'quantity'        => $request->quantity,
            'unit'            => $request->unit,
            'address'         => $request->address,
            'city'            => $request->city,
            'province'        => $request->province,
            'contact_person'  => $request->contact_person,
            'contact_phone'   => $request->contact_phone,
            'start_date'      => $request->start_date,
            'end_date'        => $request->end_date,
            'status'          => 'open',
            'logistic_status' => 'waiting_pickup',
        ]);

        return redirect()
            ->route('organization.dashboard')
            ->with('success', 'Program donasi berhasil dibuat.');
    }
}