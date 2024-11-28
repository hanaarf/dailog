<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index()
    {
        $user = User::where('role', '2')->count();
        $admin = User::where('role', '1')->count();
        $post = Post::count();
        $report = Report::count();

        $postsPerWeek = Post::selectRaw('YEAR(created_at) as year, WEEK(created_at) as week, DAYOFWEEK(created_at) as day_of_week, COUNT(*) as total')
        ->where('is_draft', '2')
        ->groupBy('year', 'week', 'day_of_week')
        ->orderBy('year', 'asc')
        ->orderBy('week', 'asc')
        ->get();


        return view('dashboard.base', compact('user', 'admin', 'post', 'report', 'postsPerWeek'));
    }

}
