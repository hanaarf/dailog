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

        // Tentukan tanggal awal dan akhir minggu aktif (Minggu ke Sabtu)
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SUNDAY);
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::SATURDAY);

        // Data postingan yang sudah dipublikasikan dalam minggu aktif
        $postsPerWeek = Post::selectRaw('DAYOFWEEK(created_at) as day_of_week, COUNT(*) as total')
            ->where('is_draft', '2')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('day_of_week')
            ->orderBy('day_of_week', 'ASC')
            ->get();

        return view('dashboard.base', compact('user', 'admin', 'post', 'report', 'postsPerWeek'));
    }
}
