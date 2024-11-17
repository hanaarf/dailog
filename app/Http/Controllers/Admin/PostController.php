<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        return view('dashboard.posts.index', compact('post'));
    }

    public function create()
    {
        return view('dashboard.posts.tambah');
    }

    public function store(Request $request)
    {
        dd($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'thumbnail' => $request->hasFile('thumbnail') ? $request->file('thumbnail')->store('thumbnails', 'public') : null,
        ]);
    
        return redirect()->route('index.post')->with('success', 'Post berhasil ditambahkan');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            // Simpan file
            $path = $request->file('upload')->store('images', 'public');
            // URL untuk gambar yang di-upload
            $url = Storage::url($path);
            // Response untuk CKEditor
            return response()->json([
                'uploaded' => true,
                'url' => asset('storage/' . $path)
            ]);
        }
        return response()->json(['uploaded' => false], 400);
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

}
