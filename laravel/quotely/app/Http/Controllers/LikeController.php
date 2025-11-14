<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quote;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    public function like(Request $request){
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication required'
            ], 401);
        }

        $request->validate([
            'quote_id' => 'required|exists:quotes,id',
        ]);

        $user = Auth::user();
        $quote = Quote::findOrFail($request->quote_id);
        
        // Vérifie si l'utilisateur a déjà liké
        $existingLike = $quote->likes()->where('user_id', $user->id)->first();
        
        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            $quote->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        $likesCount = $quote->likes()->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $likesCount
        ]);
    }
}
