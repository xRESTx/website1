<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Visit;
use Illuminate\Http\Request;
abstract class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function logVisit(Request $request)
    {
        Visit::create([
            'visited_at' => now(),
            'url' => $request->fullUrl(),
            'ip_address' => $request->ip(),
            'host' => gethostbyaddr($request->ip()) ?: null,
            'user_agent' => $request->userAgent(),
        ]);
    }
}
