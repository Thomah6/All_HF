@extends('layouts.master')

@section('title')
    Articles
@endsection

@section('content')

<h1>{{ $article->title }}</h1>
<span>Mis à jour le : {{ $article->updated_at->diffForHumans() }}</span>
<br>
<image src="{{ $article->image}}"></image>
<p>{{ $article->body }}</p>

@foreach($article->comments as $comment)
    <p><strong>{{ $comment->user->name }}</strong> a réagi :</p>
    <p>{{ $comment->comment }}</p>
    <p><small>{{ $comment->created_at->diffForHumans() }}</small></p>
@endforeach
@endsection

