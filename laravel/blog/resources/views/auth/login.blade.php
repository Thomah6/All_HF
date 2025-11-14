@extends('layouts.master')

@section('title')
Login
@endsection

@section('content')

<form method="POST" action="/login">
    <br><br>
    @csrf;
    <div>
        <label>Email</label><br>
        <input type="email" name="email" placeholder="Email">
    </div>

    <div>
        <label>Password</label><br>
        <input type="password" name="password"  placeholder="Mot de passe">
    </div>

  

    <input type="submit" name="login">
</form>

@endsection