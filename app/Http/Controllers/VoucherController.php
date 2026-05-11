<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\UserVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->paginate(10);

        $totalVouchers = Voucher::count();
        $activeVouchers = Voucher::where('status', 'active')->count();
        $inactiveVouchers = Voucher::where('status', 'inactive')->count();
        $expiredVouchers = Voucher::where('status', 'expired')->count();

        return view('admin.manage-voucher', compact(
            'vouchers',
            'totalVouchers',
            'activeVouchers',
            'inactiveVouchers',
            'expiredVouchers'
        ));
    }

    public function create()
    {
        return view('admin.create-voucher');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'nullable|string|max:100|unique:vouchers,code',
            'discount_type' => 'required|in:nominal,percentage,item',
            'discount_value' => 'required|numeric|min:0',
            'points_cost' => 'required|integer|min:0',
            'quota' => 'required|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive,expired',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vouchers', 'public');
        }

        Voucher::create([
            'title' => $request->title,
            'description' => $request->description,
            'code' => $request->code,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'points_cost' => $request->points_cost,
            'quota' => $request->quota,
            'used_count' => 0,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dibuat');
    }

    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);

        return view('admin.edit-voucher', compact('voucher'));
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'nullable|string|max:100|unique:vouchers,code,' . $voucher->id,
            'discount_type' => 'required|in:nominal,percentage,item',
            'discount_value' => 'required|numeric|min:0',
            'points_cost' => 'required|integer|min:0',
            'quota' => 'required|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive,expired',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $voucher->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vouchers', 'public');
        }

        $voucher->update([
            'title' => $request->title,
            'description' => $request->description,
            'code' => $request->code,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'points_cost' => $request->points_cost,
            'quota' => $request->quota,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil diupdate');
    }

    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dihapus');
    }

    // ===================== USER METHODS =====================

    public function userIndex()
    {
        $vouchers = Voucher::where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now()->toDateString());
            })
            ->where(function ($q) {
                $q->where('quota', 0)->orWhereRaw('used_count < quota');
            })
            ->orderBy('points_cost')
            ->get();

        $userPoints = auth()->user()->points ?? 0;
        $myVoucherIds = UserVoucher::where('user_id', auth()->id())->pluck('voucher_id');

        return view('user.vouchers', compact('vouchers', 'userPoints', 'myVoucherIds'));
    }

    public function redeem($id)
    {
        $voucher = Voucher::where('status', 'active')->findOrFail($id);
        $user    = auth()->user();

        // Cek poin cukup
        if ($user->points < $voucher->points_cost) {
            return back()->with('error', 'Poin kamu tidak cukup untuk menukar voucher ini.');
        }

        // Cek quota
        if ($voucher->quota > 0 && $voucher->used_count >= $voucher->quota) {
            return back()->with('error', 'Kuota voucher ini sudah habis.');
        }

        // Cek sudah pernah ditukar
        $alreadyRedeemed = UserVoucher::where('user_id', $user->id)
            ->where('voucher_id', $voucher->id)
            ->exists();

        if ($alreadyRedeemed) {
            return back()->with('error', 'Kamu sudah pernah menukar voucher ini.');
        }

        DB::transaction(function () use ($user, $voucher) {
            // Kurangi poin user
            $user->decrement('points', $voucher->points_cost);

            // Tambah used_count voucher
            $voucher->increment('used_count');

            // Simpan riwayat
            UserVoucher::create([
                'user_id'    => $user->id,
                'voucher_id' => $voucher->id,
                'code_used'  => $voucher->code,
                'redeemed_at' => now(),
            ]);
        });

        return redirect()->route('user.vouchers.my')
            ->with('success', 'Voucher berhasil ditukar! Sisa poin kamu: ' . ($user->fresh()->points));
    }

    public function myVouchers()
    {
        $myVouchers = UserVoucher::with('voucher')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $userPoints = auth()->user()->points ?? 0;

        return view('user.my-vouchers', compact('myVouchers', 'userPoints'));
    }
}