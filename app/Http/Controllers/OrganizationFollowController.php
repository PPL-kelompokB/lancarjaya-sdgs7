<?php

namespace App\Http\Controllers;
use App\Models\Organization;

use Illuminate\Http\Request;

class OrganizationFollowController extends Controller
{
     public function follow(Organization $organization)
    {
        auth()->user()->followedOrganizations()->syncWithoutDetaching([
            $organization->id
        ]);

        return back();
    }

    public function unfollow(Organization $organization)
    {
        auth()->user()->followedOrganizations()->detach($organization->id);

        return back();
    }
}
