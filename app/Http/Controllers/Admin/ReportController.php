<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        $adminId = Auth::id(); 

        Notification::create([
            'from_id' => $adminId, 
            'to_id' => $post->user_id, 
            'message' => 'telah menghapus postingan anda berjudul "' . $post->title . '".',
        ]);

        // Hapus postingan
        $post->delete();

        return redirect()->route('a.index.report')->with('success', 'Post berhasil dihapus');
    }

}
