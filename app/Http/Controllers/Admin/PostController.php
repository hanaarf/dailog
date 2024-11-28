<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::where('is_draft', '2')->orderBy('created_at', 'desc')->get();
        return view('dashboard.posts.index', compact('post'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $user = $post->user;
        if ($post->is_draft == '1' && $post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->get();
        
        $followers = $user->followers;
        $following = $user->following;
        return view('dashboard.posts.detail', compact('post', 'followers', 'following', 'comments'));
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

        return redirect()->route('index.post')->with('success', 'Post berhasil dihapus');
    }

}
