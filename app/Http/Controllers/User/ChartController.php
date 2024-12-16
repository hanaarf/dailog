<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function chart()
    {
        $userId = Auth::id(); // Ambil ID user yang login

        // Tentukan tanggal awal dan akhir minggu aktif (Minggu ke Sabtu)
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SUNDAY);
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::SATURDAY);

        // Data untuk postingan yang sudah dipublikasikan per hari dalam minggu aktif
        $publishedPosts = Post::where('is_draft', '2')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw('DAYOFWEEK(created_at) as day_of_week, COUNT(*) as total')
            ->groupBy('day_of_week')
            ->orderBy('day_of_week', 'ASC')
            ->get();

        // Data untuk postingan yang masih draft per hari dalam minggu aktif
        $draftPosts = Post::where('is_draft', '1')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw('DAYOFWEEK(created_at) as day_of_week, COUNT(*) as total')
            ->groupBy('day_of_week')
            ->orderBy('day_of_week', 'ASC')
            ->get();

        // Label untuk semua hari dalam minggu ini
        $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        // Data untuk chart
        $labels = $days; // Semua hari Minggu sampai Sabtu
        $publishedData = [];
        $draftData = [];

        // DAYOFWEEK mengembalikan 1 untuk Minggu, 2 untuk Senin, dst.
        foreach (range(1, 7) as $dayOfWeek) { // Minggu (1) sampai Sabtu (7)
            $publishedData[] = $publishedPosts->where('day_of_week', $dayOfWeek)->first()->total ?? 0;
            $draftData[] = $draftPosts->where('day_of_week', $dayOfWeek)->first()->total ?? 0;
        }

        return view('website.charts.index', compact('labels', 'publishedData', 'draftData'));
    }
}
