<?php

namespace App\Http\Controllers;

use App\Models\Interest;

class InterestController extends Controller
{
    public function index()
    {
        $interests = Interest::INTERESTS;

        return view('interests', compact('interests'));
    }
}
