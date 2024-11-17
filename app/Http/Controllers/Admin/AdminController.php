<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dataAdmin()
    {
        $admin = User::where('role', '1')->get();
        return view('dashboard.dataAdmin.index', compact('admin'));
    }

    public function createAdmin()
    {
        return view('dashboard.dataAdmin.create');
    }

    public function tambahAdmin(Request $request)
    {
        User::create([
            'name' =>$request->name,
            'role' =>$request->role,
            'username' =>$request->username,
            'email' =>$request->email,
            'password' => bcrypt($request->password),
            'bio' =>$request->bio,
            'image' => $request->hasFile('image') ? $request->file('image')->store('users') : null,
        ]);

        return redirect()->route('index.admin')->with('Sukses', 'Admin Berhasil Ditambahkan');
    }

    public function editAdmin($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.dataAdmin.edit', compact('user'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
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

        return redirect()->route('index.admin')->with('Sukses', 'Data Admin Berhasil Di Update');
    }

    public function showAdmin($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.dataAdmin.index', compact('Admin'));
    }

    public function deleteAdmin(Request $request)
    {
        $user = User::findOrFail($request->id);
        if ($user->image && Storage::exists('public/' . $user->image)) {
            Storage::delete('public/' . $user->image);
        }
        $user->delete();
        return redirect()->back()->with('Delete', 'berhasil menghapus Admin');
    }
}
