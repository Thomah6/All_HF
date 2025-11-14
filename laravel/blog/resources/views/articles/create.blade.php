@extends('layouts.master')

@section('title', 'Créer un article')

@section(section: 'content')

<form method="POST" action="/articles/create" enctype="multipart/form-data">
<br><br>
  @csrf
@include('partials.article-form')
</form>

@endsection