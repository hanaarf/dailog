<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id); 
        $post = Post::where('user_id', $id)->where('is_draft', 2)->orderBy('created_at', 'desc')->get();
        $draft = Post::where('user_id', $id)->where('is_draft', 1)->orderBy('created_at', 'desc')->get();
        $randomPost = Post::where('is_draft', '2')->where('user_id', '!=', Auth::id())->inRandomOrder()->limit(2)->get();
        $randomUser = User::where('role', '2')->where('id', '!=', Auth::id())->inRandomOrder()->limit(3)->get();
        return view('website.users.profile', compact('user', 'post', 'randomPost', 'randomUser', 'draft')); 
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('website.users.setting', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'bio' => $request->bio,
            'password' => bcrypt($request->password),
        ];

        if ($request->hasFile('image')) {
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }
            $data['image'] = $request->file('image')->store('users');
        }

        $user->update($data);

        return redirect()->route('profile.show', $id)->with('Sukses', 'Data Admin Berhasil Di Update');
    }
}
