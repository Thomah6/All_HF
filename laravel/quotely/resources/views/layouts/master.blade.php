<!DOCTYPE html>
<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Quotely - Accueil</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&amp;family=Outfit:wght@700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#6a25f4",
                        "background-light": "#f6f5f8",
                        "background-dark": "#161022",
                    },
                    fontFamily: {
                        "display": ["Space Grotesk", "sans-serif"],
                        "heading": ["Outfit", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
            .neon-glow-text {
            text-shadow: 0 0 5px rgba(79, 70, 229, 0.5), 0 0 10px rgba(79, 70, 229, 0.4), 0 0 20px rgba(217, 70, 239, 0.3);
        }
        .neon-glow-border-hover {
            position: relative;
            z-index: 1;
        }
        .neon-glow-border-hover::before {
            content: "";
            position: absolute;
            inset: -2px;
            border-radius: calc(1rem + 2px);
            background: linear-gradient(120deg, #4F46E5, #D946EF);
            filter: blur(8px);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            z-index: -1;
        }
        .neon-glow-border-hover:hover::before {
            opacity: 0.75;
        }
    </style>
    </head>


<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">
<div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<!-- TopNavBar -->
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200/50 dark:border-gray-700/50 px-6 sm:px-10 md:px-20 lg:px-40 py-4 sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm">
<div class="flex items-center gap-4 text-gray-900 dark:text-white">
<div class="size-6 text-primary">
<svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<path clip-rule="evenodd" d="M24 4H6V17.3333V30.6667H24V44H42V30.6667V17.3333H24V4Z" fill="currentColor" fill-rule="evenodd"></path>
</svg>
</div>
<a href="/">

    <h2 class="text-xl font-bold font-heading">Quotely</h2>
</a>
</div>

<div class="flex items-center gap-2">
    @guest
<a href="{{ route('login') }}"><button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 text-sm font-bold hover:bg-gray-300 dark:hover:bg-gray-700 transition-colors">
<span class="truncate">Connexion</span>
</button></a>
<a href="{{ route('register') }}"> <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-primary text-white text-sm font-bold hover:opacity-90 transition-opacity">
<span class="truncate">Inscription</span>
</button>
    </a>
    @endguest
   @auth
    <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 text-gray-700 text-sm font-bold hover:opacity-90 transition-opacity">
        <span class="truncate">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
    </button>

    {{-- Bouton Dash uniquement pour admin --}}
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('dashboard') }}">
            <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-primary text-white text-sm font-bold hover:opacity-90 transition-opacity">
                <span class="truncate">Dash Admin</span>
            </button>
        </a>
    @elseif(auth()->user()->role === 'editor')
     <a href="{{ route('profil') }}">
            <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-primary text-white text-sm font-bold hover:opacity-90 transition-opacity">
                <span class="truncate">Profil</span>
            </button>
        </a>
     <a href="{{ route('create') }}">
            <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-primary text-white text-sm font-bold hover:opacity-90 transition-opacity">
                <span class="truncate">Add Quote</span>
            </button>
        </a>
    @endif

    <a href="{{ route('logout') }}">
        <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-primary text-white text-sm font-bold hover:opacity-90 transition-opacity">
            <span class="truncate">Deconnexion</span>
        </button>
    </a>
@endauth

</div>
</header>

    @yield('content')

<!-- Footer -->
<footer class="bg-gray-100 dark:bg-gray-900/50 mt-20">
<div class="max-w-6xl mx-auto px-6 sm:px-10 md:px-20 lg:px-40 py-12">
<div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-8 text-center text-sm text-gray-500 dark:text-gray-400">
<p>© 2025 Quotely. Tous droits réservés.</p>
</div>
</div>
</footer>
</div>
</div>
    @stack('scripts')
</body>
</html>
