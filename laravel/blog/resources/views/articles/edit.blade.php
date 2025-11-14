@extends('layouts.master')

@section('title')
<h2>

    Éditer l'article
    {{ $article->title }}
</h2>
@endsection

@section('content')
<br><br>
    <form action="{{url('article/'.  $article->id  . '/edit')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        @include('partials.article-form')
    </form>

    <form action="/article/{{ $article->id }}/delete" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Effacer l'article">
    </form>


@endsection