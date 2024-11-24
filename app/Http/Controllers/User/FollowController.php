<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow($id)
    {
        $followerId = Auth::id();
        $followedId = $id;

        $follow = Follow::firstOrNew(['follower_id' => $followerId, 'followed_id' => $followedId]);

        if ($follow->exists) {
            $follow->delete();
        } else {
            $follow->save(); 
        }

        return back(); 
    }
}
