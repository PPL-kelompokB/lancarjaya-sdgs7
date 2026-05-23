<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

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
}