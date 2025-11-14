@extends('layouts.master')

@section('title')
Register
@endsection

@section('content')

<form method="POST" action="/register">
    <br><br>
    @csrf

    <div>
        <label>Name</label><br>
        <input type="text" name="name" placeholder="Votre nom">
    </div>

    <div>
        <label>Email</label><br>
        <input type="email" name="email" placeholder="Email">
    </div>

    <div>
        <label>Password</label><br>
        <input type="password" name="password"  placeholder="Mot de passe">
    </div>

    <div>
        <label>Password Confirmation</label><br>
        <input type="password" name="pc" placeholder="Confirmez le mot de passe">
    </div>

    <input type="submit" name="register">
</form>

@endsection