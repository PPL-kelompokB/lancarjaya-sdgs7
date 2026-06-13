<?php

namespace App\Http\Controllers;
use App\Models\Organization;
use App\Models\VolunteerRequest;
use App\Models\Donation;
use Illuminate\Http\Request;


class MonitoringController extends Controller
{
   public function index()
    {
        $organizations = Organization::with([
            'volunteerRequests',
            'donations'
        ])->get();

        return view('admin.monitoring.index', compact(
            'organizations'
        ));
    }
}