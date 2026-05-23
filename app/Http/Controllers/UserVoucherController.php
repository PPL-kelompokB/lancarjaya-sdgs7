<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Voucher;
use App\Models\UserPoints;
use App\Models\VoucherRedemption;

class UserVoucherController extends Controller
{
    /**
     * Display vouchers available for redemption
     */
    public function index()
    {
        $user = Auth::user();
        $userPoints = UserPoints::firstOrCreate(
            ['user_id' => $user->id],
            ['total_points' => 0, 'used_points' => 0, 'available_points' => 0]
        );

        // Get available vouchers
        $vouchers = Voucher::where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            })
            ->where('quota', '>', \DB::raw('used_count'))
            ->latest()
            ->get();

        // Get user's redeemed vouchers
        $redeemedVouchers = VoucherRedemption::where('user_id', $user->id)
            ->with('voucher')
            ->latest()
            ->take(10)
            ->get();

        return view('user.vouchers', compact(
            'userPoints',
            'vouchers',
            'redeemedVouchers'
        ));
    }

    /**
     * Redeem voucher using points
     */
    public function redeem(Request $request, $voucherId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $voucher = Voucher::findOrFail($voucherId);

        // Check if voucher is available
        if ($voucher->status !== 'active') {
            return back()->with('error', 'Voucher tidak tersedia');
        }

        if ($voucher->quota <= $voucher->used_count) {
            return back()->with('error', 'Kuota voucher sudah habis');
        }

        if ($voucher->end_date && $voucher->end_date < now()) {
            return back()->with('error', 'Voucher sudah expired');
        }

        // Check user points
        $userPoints = UserPoints::where('user_id', $user->id)->first();
        if (!$userPoints || $userPoints->available_points < $voucher->points_cost) {
            return back()->with('error', 'Poin tidak cukup untuk menukar voucher ini');
        }

        // Deduct points
        if (!UserPoints::deductPoints($user->id, $voucher->points_cost)) {
            return back()->with('error', 'Gagal mengurangi poin');
        }

        // Create redemption record
        $redemptionCode = VoucherRedemption::generateRedemptionCode();
        
        $redemption = VoucherRedemption::create([
            'user_id' => $user->id,
            'voucher_id' => $voucher->id,
            'points_spent' => $voucher->points_cost,
            'redemption_code' => $redemptionCode,
            'status' => 'active',
            'redeemed_at' => now(),
            'expired_at' => $voucher->end_date,
        ]);

        // Update voucher used count
        $voucher->increment('used_count');

        return back()->with('success', "Voucher berhasil ditukar! Kode: {$redemptionCode}");
    }

    /**
     * Show voucher detail and redemption history
     */
    public function show($voucherId)
    {
        $user = Auth::user();
        $voucher = Voucher::findOrFail($voucherId);

        $userPoints = UserPoints::firstOrCreate(
            ['user_id' => $user->id],
            ['total_points' => 0, 'used_points' => 0, 'available_points' => 0]
        );

        $userRedemptions = VoucherRedemption::where('user_id', $user->id)
            ->where('voucher_id', $voucher->id)
            ->latest()
            ->get();

        return view('user.voucher-detail', compact(
            'voucher',
            'userPoints',
            'userRedemptions'
        ));
    }

    /**
     * View user's voucher redemption history
     */
    public function history()
    {
        $user = Auth::user();

        $userPoints = UserPoints::firstOrCreate(
            ['user_id' => $user->id],
            ['total_points' => 0, 'used_points' => 0, 'available_points' => 0]
        );

        $redemptions = VoucherRedemption::where('user_id', $user->id)
            ->with('voucher')
            ->latest()
            ->paginate(15);

        return view('user.voucher-history', compact(
            'userPoints',
            'redemptions'
        ));
    }

    /**
     * Add points to user (can be called when user completes activities)
     */
    public static function addPointsToUser($userId, $points, $description = null)
    {
        return UserPoints::addPoints($userId, $points);
    }
}
