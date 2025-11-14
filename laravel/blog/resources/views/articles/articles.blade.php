@extends('layouts.master')

@section('title', 'Article');
<!-- fhjdfghjfhjdfdfhjfhjfhd -->

@section('content')

@if($articles)
    @foreach($articles as $article)
       @include('partials.article')
    @endforeach
@else
<p>Pas d'articles disponibles</p>
@endif


<h2>Articles</h2>
@endsection