<?php

namespace App\Http\Controllers;

use App\Models\UserPoints;

class PointRewardController extends Controller
{
    public function index()
    {
        $points = UserPoints::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'total_points' => 0,
                'used_points' => 0,
                'available_points' => 0,
            ]
        );

        return view(
            'user.pointReward',
            compact('points')
        );
    }

    public function leaderboard()
    {
        $leaderboard = UserPoints::with('user')
            ->orderByDesc('total_points')
            ->get();

        return view(
            'user.leaderboard',
            compact('leaderboard')
        );
    }
}