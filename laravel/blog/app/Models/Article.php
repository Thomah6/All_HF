<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    /** 
     * @use HasFactory<\Database\Factories\ArticleFactory>
     */
    use HasFactory;
    protected $fillable = ['id','title', 'body', 'user_id', 'image'];

    protected $appends = [
    'author'
];
// !! Le nom de cette méthode n'est pas optionnel !!
// get 'author' attribute
// méthode obligatoire pour faire fonctionner notre $appends
public function getAuthorAttribute()
{
    return $this->user->name;
}
    // Un article n'a qu'un auteur
public function user()
{
    return $this->belongsTo(User::class);
}
// Un article peut avoir plusieurs commentaires
public function comments()
{
    return $this->hasMany(Comment::class);
}

}
