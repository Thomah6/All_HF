@extends('layouts.master')

@push('styles')
<style>
    .like-btn {
        transition: all 0.3s ease;
    }

    .like-btn.liked {
        color: #ef4444;
    }

    .like-btn:hover {
        transform: scale(1.1);
    }
</style>
@endpush

@section('content')
<main class="flex-1 px-6 sm:px-10 md:px-20 lg:px-40 py-5">
    <div class="layout-content-container flex flex-col max-w-6xl mx-auto flex-1">
        <!-- HeroSection -->
        <section class="flex min-h-[480px] flex-col gap-6 items-center justify-center p-4 text-center my-12 rounded-xl bg-gray-100 dark:bg-gray-900/50 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-transparent to-pink-500/10 dark:from-primary/20 dark:to-pink-500/20"></div>
            <div class="relative z-10 flex flex-col items-center gap-4">
                <h1 class="text-5xl font-black leading-tight tracking-tighter sm:text-7xl md:text-8xl font-heading text-gray-900 dark:text-white neon-glow-text">
                    Quotely
                </h1>
                <h2 class="text-base font-normal leading-normal sm:text-lg text-gray-600 dark:text-gray-300 max-w-xl">
                    Découvrez, collectionnez et partagez le pouvoir des mots qui inspirent et transforment.
                </h2>
            </div>
        </section>
        <!-- SectionHeader -->
        <h2 class="text-3xl font-bold leading-tight tracking-tight font-heading text-gray-900 dark:text-white px-4 pb-4 pt-10">
            Quotefeed
        </h2>

        <!-- barre de recherche -->
        <form action="{{ route('home') }}" method="GET" class="mb-6">
            <div class="relative w-full max-w-2xl">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                <input 
                    name="search"
                    value="{{ request('search') }}"
                    class="w-full h-12 pl-10 pr-6 rounded-full border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 shadow-sm text-gray-700" 
                    placeholder="Rechercher une citation ou un auteur..." 
                    type="search"
                />
                @if(request('search'))
                    <a href="{{ route('home') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </a>
                @endif
            </div>
        </form>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @if($quotes)
            @foreach( $quotes as $quote)

            <div class="group overflow-hidden bg-white rounded-lg relative neon-border neon-glow p-6 flex flex-col justify-between">
                
                 <div class="absolute inset-0 z-10 bg-gradient-to-br from-primary/10 via-transparent to-pink-500/10 dark:from-primary/20 dark:to-pink-500/20"></div>

                <div>
                    <p class="text-black text-xl font-bold leading-tight tracking-[-0.015em] mb-4">" {{ $quote->content }}"</p>
                    <p class="text-gray-500 text-base font-normal leading-normal">— {{ $quote->author }}</p>
                </div>

                <div class="flex z-50 items-center justify-between mt-6">
                    <button class="like-btn flex items-center gap-2 text-gray-500 @if($quote->likes->contains('user_id', auth()->id())) liked text-red-500 border-red-200 @endif border border-gray-200 rounded-full py-1.5 px-3 hover:border-red-200 transition-colors"
                        onclick="toggleLike({{ $quote->id }})"
                        id="like-btn-{{ $quote->id }}">
                        <span class="material-symbols-outlined text-lg" id="like-icon-{{ $quote->id }}">
                            {{ $quote->likes->contains('user_id', auth()->id()) ? 'favorite' : 'favorite_border' }}
                        </span>
                        <span class="text-sm font-medium" id="like-count-{{ $quote->id }}">
                            {{ $quote->likes_count ?? $quote->likes->count() }}
                        </span>
                    </button>
                    <p class="text-gray-400 text-sm font-normal leading-normal">Publié le {{ $quote->created_at }}</p>
                </div>
            </div>

            @endforeach
            @endif

        </div>
    </div>
</main>
@push('scripts')
<script>
    function toggleLike(quoteId) {
        const likeBtn = document.getElementById(`like-btn-${quoteId}`);
        const likeIcon = document.getElementById(`like-icon-${quoteId}`);
        const likeCount = document.getElementById(`like-count-${quoteId}`);

        likeBtn.disabled = true;

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('quote_id', quoteId);

        fetch('{{ route("like") }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => {
                if (response.status === 401) { // Unauthorized
                    window.location.href = '{{ route("login") }}?redirect=' + encodeURIComponent(window.location.pathname);
                    return Promise.reject('User not authenticated');
                }
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {

                    likeIcon.textContent = data.liked ? 'favorite' : 'favorite_border';
                    likeCount.textContent = data.likes_count;


                    if (data.liked) {
                        likeBtn.classList.add('liked', 'text-red-500', 'border-red-200');
                        likeBtn.classList.remove('text-gray-500');
                    } else {
                        likeBtn.classList.remove('liked', 'text-red-500', 'border-red-200');
                        likeBtn.classList.add('text-gray-500');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);

            })
            .finally(() => {

                likeBtn.disabled = false;
            });
    }
</script>
@endpush

@endsection