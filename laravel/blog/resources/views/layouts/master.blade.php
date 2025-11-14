<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Mon projet laravel</h1>
    @yield('title')
    <br>
    <a href="/contact-us">Contactez-nous</a>
    <a href="/about">A propos de nous</a>
    <a href="/articles">Articles</a><br>

    @auth
    <a href="/article/create"><button>Creer un article</button></a>
    <a href="/create-us">Ajoutez un article</a>
    @endauth

    @guest
    <a href="{{ route('login') }}"><button>Login</button></a>
    <a href="{{ route('register') }}"><button>S'inscrire</button></a>
    @endguest

    @auth
    <a href="{{ route('profile') }}">Votre profil</a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <input type="submit" value="Se déconnecter">
    </form>
    @endauth

    @include('messages.allMessages')
    @yield('content')
</body>

</html>