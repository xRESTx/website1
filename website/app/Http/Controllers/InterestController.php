<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function index(Request $request){
        $this->logVisit($request);
        $interests = Interest::INTERESTS;

        return view('interests', compact('interests'));
    }
}
