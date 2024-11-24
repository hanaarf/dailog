<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function report(Request $request)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        Report::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'reason' => $validated['reason'],
        ]);

        return redirect()->back()->with('success', 'Report submitted successfully!');
    }
}
