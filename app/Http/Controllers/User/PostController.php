<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::where('is_draft', '2')->orderBy('created_at', 'desc')->get();
        $randomPost = Post::where('is_draft', '2')->where('user_id', '!=', Auth::id())->inRandomOrder()->limit(2)->get();
        $randomUser = User::where('role', '2')->where('id', '!=', Auth::id())->inRandomOrder()->limit(3)->get();
        return view('website.posts.index', compact('post', 'randomPost', 'randomUser'));
    }

    public function indexdraft()
    {
        $post = Post::where('is_draft', '1')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $randomPost = Post::where('is_draft', '2')->inRandomOrder()->limit(2)->get();
        $randomUser = User::where('role', '2')->inRandomOrder()->limit(3)->get();
        return view('website.posts.draft', compact('post', 'randomPost', 'randomUser'));
    }

    public function indexlike()
    {
        $userId = Auth::id();
        $post = Post::whereHas('likes', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }) ->where('is_draft', '2')
        ->get();
        $randomPost = Post::where('is_draft', '2')->inRandomOrder()->limit(2)->get();
        $randomUser = User::where('role', '2')->inRandomOrder()->limit(3)->get();
        return view('website.posts.liked', compact('post', 'randomPost', 'randomUser'));
    }

    public function indexmark()
    {
        $userId = Auth::id();
        $post = Post::whereHas('bookmarks', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }) ->where('is_draft', '2')
        ->get();
        $randomPost = Post::where('is_draft', '2')->inRandomOrder()->limit(2)->get();
        $randomUser = User::where('role', '2')->inRandomOrder()->limit(3)->get();
        return view('website.posts.marked', compact('post', 'randomPost', 'randomUser'));
    }

    public function indexfollow()
    {
        $user = Auth::user();
        $followingIds = DB::table('follows')->where('follower_id', $user->id)->pluck('followed_id');
        $post = Post::whereIn('user_id', $followingIds)->where('is_draft', '2')->get();

        $randomPost = Post::where('is_draft', '2')->inRandomOrder()->limit(2)->get();
        $randomUser = User::where('role', '2')->inRandomOrder()->limit(3)->get();
        return view('website.posts.followed', compact('post', 'randomPost', 'randomUser'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        if ($post->is_draft == '1' && $post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->get();
        $commentsCount = Comment::where('post_id', $id)->count();
        return view('website.posts.show', compact('post', 'comments', 'commentsCount'));
    }

    public function create()
    {
        $post = Post::all();
        return view('website.posts.create');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            // Simpan file ke storage/media
            $filePath = $request->file('upload')->storeAs('media', $fileName);

            // Generate URL untuk akses file
            $url = asset('storage/media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Tentukan nilai is_draft berdasarkan request, default-nya 2 jika tidak diisi
        $isDraft = $request->input('is_draft', '2');
    
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'thumbnail' => $request->hasFile('thumbnail') ? $request->file('thumbnail')->store('thumbnails', 'public') : null,
            'is_draft' => $isDraft,
        ]);
    
        return redirect()->route('index.home')->with('success', 'Post berhasil ditambahkan');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id); 
        return view('website.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $userId = Auth::id();

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Jika ada thumbnail baru, hapus thumbnail lama
        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail); 
            }
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        } else {
            $thumbnailPath = $post->thumbnail; // Tetap gunakan thumbnail lama
        }

        $isDraft = $request->input('is_draft', $post->is_draft);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'is_draft' => $isDraft,
        ]);

        return redirect()->route('profile.show', $userId)->with('success', 'Post berhasil diperbarui');
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $userId = Auth::id();

        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        $post->delete();

        return redirect()->route('profile.show', $userId)->with('success', 'Post berhasil dihapus');
    }

    public function storeComment(Request $request, $postId)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'comment' => $validated['comment'],
        ]);

        session()->flash('openModal', true);
        return back();
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $blogs = Post::where('title', 'LIKE', "%$keyword%")->where('is_draft', '2')->get();
        $users = User::where('name', 'LIKE', "%$keyword%")->get();
        $randomPost = Post::where('is_draft', '2')->where('user_id', '!=', Auth::id())->inRandomOrder()->limit(2)->get();
        $randomUser = User::where('role', '2')->where('id', '!=', Auth::id())->inRandomOrder()->limit(3)->get();
        return view('website.posts.search', compact('keyword', 'blogs', 'users', 'randomPost', 'randomUser'));
    }

    public function like(Request $request)
    {
        $existingLike = Like::where('user_id', Auth::id())
                            ->where('post_id', $request->post_id)
                            ->first();

        if (!$existingLike) {
            $like = new Like();
            $like->user_id = Auth::id();
            $like->post_id = $request->post_id;
            $like->save();
        }

        return response()->json(['success' => true]);
    }


    public function unlike(Request $request)
    {
        $like = Like::where('user_id', Auth::id())
                    ->where('post_id', $request->post_id)
                    ->first();

        if ($like) {
            $like->delete();
        }

        return response()->json(['success' => true]);
    }

    public function deletenotif($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }


}
