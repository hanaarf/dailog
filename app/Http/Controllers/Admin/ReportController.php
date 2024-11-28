<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $report = Report::selectRaw('post_id, COUNT(*) as total_report')
        ->with(['post', 'user'])
        ->groupBy('post_id')
        ->get();

        return view('dashboard.report.index', compact('report'));
    }

    public function destroy($post_id)
    {
        Report::where('post_id', $post_id)->delete();

        return redirect()->route('a.index.report')->with('success', 'Reports deleted successfully.');
    }

}
