<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function create()
    {
        $organization = auth()->user()->organization;

        if (!$organization || $organization->verification_status !== 'verified') {
            return redirect()
                ->route('organization.dashboard')
                ->with('error', 'Organisasi harus terverifikasi dulu sebelum membuka donasi.');
        }

        return view('organization.createDonation', compact('organization'));
    }

    public function store(Request $request)
    {
        $organization = auth()->user()->organization;

        if (!$organization || $organization->verification_status !== 'verified') {
            return redirect()
                ->route('organization.dashboard')
                ->with('error', 'Organisasi harus terverifikasi dulu sebelum membuka donasi.');
        }

        $request->validate([
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
            'organization_id' => $organization->id,
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

    public function edit($id)
    {
        $organization = auth()->user()->organization;

        $donation = Donation::where('id', $id)
            ->where('organization_id', $organization->id)
            ->firstOrFail();

        return view('organization.editDonation', compact('donation', 'organization'));
    }

    public function update(Request $request, $id)
    {
        $organization = auth()->user()->organization;

        $donation = Donation::where('id', $id)
            ->where('organization_id', $organization->id)
            ->firstOrFail();

        $request->validate([
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

        $donation->update([
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
        ]);

        return redirect()
            ->route('organization.dashboard')
            ->with('success', 'Program donasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $organization = auth()->user()->organization;

        $donation = Donation::where('id', $id)
            ->where('organization_id', $organization->id)
            ->firstOrFail();

        $donation->delete();

        return redirect()
            ->route('organization.dashboard')
            ->with('success', 'Program donasi berhasil dihapus.');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}