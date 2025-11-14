<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;

class Quote extends Model
{
     protected $fillable = [
        'content',
        'author',
        'is_published',
        'user_id'
    ];

    /**
     * Get the user that owns the quote.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the likes for the quote.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get the users who liked the quote.
     */
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes', 'quote_id', 'user_id');
    }
}
