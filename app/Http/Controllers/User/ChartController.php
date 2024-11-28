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

  
        // Data untuk postingan yang sudah dipublikasikan per hari
        $publishedPosts = Post::where('is_draft', '2')
            ->where('user_id', $userId)
            ->selectRaw('DAYOFWEEK(created_at) as day_of_week, COUNT(*) as total')
            ->groupBy('day_of_week')
            ->orderBy('day_of_week', 'ASC')
            ->get();

        // Data untuk postingan yang masih draft per hari
        $draftPosts = Post::where('is_draft', '1')
            ->where('user_id', $userId)
            ->selectRaw('DAYOFWEEK(created_at) as day_of_week, COUNT(*) as total')
            ->groupBy('day_of_week')
            ->orderBy('day_of_week', 'ASC')
            ->get();

        // Label untuk hari-hari Senin sampai Jumat
        $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        // Data untuk chart
        $labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri']; // Label yang ditampilkan hanya Senin sampai Jumat
        $publishedData = [];
        $draftData = [];

        // Mengisi data untuk chart berdasarkan hari Senin sampai Jumat
        foreach (range(2, 6) as $dayOfWeek) { // Hanya Senin (2) sampai Jumat (6)
            $publishedData[] = $publishedPosts->where('day_of_week', $dayOfWeek)->first()->total ?? 0;
            $draftData[] = $draftPosts->where('day_of_week', $dayOfWeek)->first()->total ?? 0;
        }

    return view('website.charts.index', compact('labels', 'publishedData', 'draftData'));

   }
}
