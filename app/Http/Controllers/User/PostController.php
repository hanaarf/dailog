<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function show($id)
    {
        $post = Post::findOrFail($id);
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
       if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
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
        $blogs = Post::where('title', 'LIKE', "%$keyword%")->get();
        $users = User::where('name', 'LIKE', "%$keyword%")->get();
        $randomPost = Post::where('is_draft', '2')->where('user_id', '!=', Auth::id())->inRandomOrder()->limit(2)->get();
        $randomUser = User::where('role', '2')->where('id', '!=', Auth::id())->inRandomOrder()->limit(3)->get();
        return view('website.posts.search', compact('keyword', 'blogs', 'users', 'randomPost', 'randomUser'));
    }


}
