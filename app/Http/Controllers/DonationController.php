<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\DonationSubmission;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Show donation detail page
     */
    public function show($id)
    {
        $donation = Donation::with('organization')
            ->findOrFail($id);

        return view('user.explore-detail-donation', compact('donation'));
    }

    /**
     * Show donate form
     */
    public function showDonateForm($id)
    {
        $donation = Donation::findOrFail($id);

        return view('user.donate-form', compact('donation'));
    }

    /**
     * Submit donation
     */
    public function submitDonation(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|max:50',

            'pickup_address' => 'required|string',

            'phone_number' => 'required|string|max:20',

            'pickup_date' => 'required|date',

            'notes' => 'nullable|string',

            'pickup_proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload image
        $imagePath = null;

        if ($request->hasFile('pickup_proof_image')) {

            $imagePath = $request
                ->file('pickup_proof_image')
                ->store('donation_proofs', 'public');
        }

        // Save submission
        DonationSubmission::create([

            'donation_id' => $donation->id,

            'user_id' => Auth::id(),

            'item_name' => $validated['item_name'],

            'quantity' => $validated['quantity'],

            'unit' => $validated['unit'],

            'pickup_address' => $validated['pickup_address'],

            'phone_number' => $validated['phone_number'],

            'pickup_date' => $validated['pickup_date'],

            'notes' => $validated['notes'] ?? null,

            'pickup_proof_image' => $imagePath,

            'status' => 'pending',
        ]);

        return redirect()
            ->route('donation.detail', $donation->id)
            ->with('success', 'Donation submitted successfully!');
    }

    /**
     * Update donation submission status
     */
    public function updateStatus(Request $request, $submissionId)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,completed,cancelled',
        ]);

        $submission = DonationSubmission::findOrFail($submissionId);

        $submission->status = $validated['status'];

        $submission->save();

        return back()->with(
            'success',
            'Donation status updated successfully.'
        );
    }

    /**
     * User donation history
     */
    public function myDonations()
    {
        $submissions = DonationSubmission::with('donation')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.my-donations', compact('submissions'));
    }

    public function organizationDetail($id)
    {
        $donation = Donation::with([
            'organization',
            'submissions.user'
        ])->findOrFail($id);

        return view(
            'organization.donation-detail',
            compact('donation')
        );
    }
}
