<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function dataUser()
    {
        $user = User::where('role', '2')->get();
        return view('dashboard.dataUser.index', compact('user'));
    }

    public function createUser()
    {
        return view('dashboard.dataUser.create');
    }

    public function tambahUser(Request $request)
    {
        User::create([
            'name' =>$request->name,
            'username' =>$request->username,
            'email' =>$request->email,
            'password' => bcrypt($request->password),
            'bio' =>$request->bio,
            'image' => $request->hasFile('image') ? $request->file('image')->store('users') : null,
        ]);

        return redirect()->route('index.user')->with('Sukses', 'User Berhasil Ditambahkan');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.dataUser.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'bio' => $request->bio,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $user->password; 
        }
        
        if ($request->hasFile('image')) {
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }
            $data['image'] = $request->file('image')->store('users');
        }

        $user->update($data);

        return redirect()->route('index.user')->with('Sukses', 'Data User Berhasil Di Update');
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.dataUser.index', compact('user'));
    }

    public function deleteUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        if ($user->image && Storage::exists('public/' . $user->image)) {
            Storage::delete('public/' . $user->image);
        }
        $user->delete();
        return redirect()->back()->with('Delete', 'berhasil menghapus user');
    }
    
}
