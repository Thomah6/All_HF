<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Quote;

class Like extends Model
{
    protected $fillable = [
        'quote_id',
        'user_id',
    ];

    /**
     * Get the user that owns the like.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the quote that was liked.
     */
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
