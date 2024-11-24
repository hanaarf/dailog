<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function toggleBookmark(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);
    
        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('post_id', $request->post_id)
            ->first();
    
        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['status' => 'unbookmarked']);
        } else {
            Bookmark::create([
                'user_id' => Auth::id(),
                'post_id' => $request->post_id,
            ]);
            return response()->json(['status' => 'bookmarked']);
        }
    }
    
}
