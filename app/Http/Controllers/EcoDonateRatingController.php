<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EcoDonateRatingController extends Controller
{
    public function index()
    {
        return view('ecodonate.rating');
    }
}