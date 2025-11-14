{{-- @extends('layouts.master'); --}}
<p> {{ $article->title }} </p>
<image src="{{ $article["image"] }}" style="width:300px"></image><br>
<a href="/article/{{ $article->title }}">Voir l'article</a>
<a href="/article/{{ $article->id }}/edit"><button>Modifier</button></a>
