@extends('layouts.master')

@section('content')
<main class="flex flex-col gap-8 mt-8 ">

<div class="lg:min-w-[1400px] mx-auto">
<div class="flex flex-wrap justify-between gap-3  p-4">
<div class="flex min-w-72 flex-col gap-2">
<p class="text-text-light text-4xl font-black leading-tight tracking-[-0.033em]">Tableau de Bord de l'Auteur</p>
<p class="text-text-light/60 text-base font-normal leading-normal">Gérez vos informations et vos citations.</p>
</div>
</div>
<div class="flex p-4 @container bg-white rounded-lg border border-gray-200 shadow-sm">
<div class="flex w-full flex-col gap-6 @[520px]:flex-row @[520px]:justify-between @[520px]:items-center">
<div class="flex items-center gap-6">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full min-h-32 w-32" data-alt="Avatar de Jean Dupont en gros plan" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA8dSLa2UeGKhKRdfjPTCs5g8Ktxj9AQpfohkosphUMrl9y65yizrgJ6949-ZsqD33uh-Lb1-Vdf-SyYbzNjNzpHD1hyrtvsZme8oaToBEDkT5KhUpDI5RAp0S7B8tlkENUqtMQRKYittS-B749OxdR4NMdzINWO2gsc0JClw6Ju5Sz5Xpw9wA_n5_IslogyWwxZyrY1IWJNEyajX-FEairNnwMDaMucWI-6j61ppWj3zgQ5yvwAlDEgIzVdQ7fg9-zGoWutbU1Cg");'></div>
<div class="flex flex-col justify-center gap-1">
<p class="text-text-light text-[22px] font-bold leading-tight tracking-[-0.015em]">{{ $user->name }}</p>
<p class="text-text-light/60 text-base font-normal leading-normal">{{ $user->email }}</p>
</div>
</div>

</div>
</div>
<div class="flex flex-wrap gap-4 px-4 py-3">
<div class="flex min-w-[111px] flex-1 basis-[fit-content] flex-col gap-2 rounded-lg border border-gray-200 p-4 items-start bg-white shadow-sm">
<p class="text-accent-blue text-3xl font-bold leading-tight">{{ $quotescount }}</p>
<div class="flex items-center gap-2"><p class="text-text-light/60 text-sm font-normal leading-normal">Citations totales</p></div>
</div>
<div class="flex min-w-[111px] flex-1 basis-[fit-content] flex-col gap-2 rounded-lg border border-gray-200 p-4 items-start bg-white shadow-sm">
<p class="text-accent-magenta text-3xl font-bold leading-tight">{{ $publishedcount }}</p>
<div class="flex items-center gap-2"><p class="text-text-light/60 text-sm font-normal leading-normal">Citations publiées</p></div>
</div>
</div>
<div class="flex flex-col gap-6">
<h2 class="text-text-light text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pt-5">Mes Citations</h2>
<!-- Toolbar -->
<div class="flex flex-col md:flex-row gap-4 items-center justify-between px-4">
<!-- <div class="relative w-full md:max-w-xs">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-light/40">search</span>
<input class="w-full h-10 pl-10 pr-4 rounded-full border-gray-300 focus:ring-accent-blue focus:border-accent-blue transition-colors text-sm" placeholder="Rechercher une citation..." type="text"/>
</div> -->
<div class="flex gap-2">
<button class="px-4 py-1.5 rounded-full text-sm font-medium bg-accent-blue/10 text-accent-blue border border-accent-blue/20">Toutes</button>
<!-- <button class="px-4 py-1.5 rounded-full text-sm font-medium text-text-light/60 hover:bg-gray-100">Publiées</button>
<button class="px-4 py-1.5 rounded-full text-sm font-medium text-text-light/60 hover:bg-gray-100">En attente</button> -->
</div>
</div>
<!-- Quotes List -->
<div class="flex flex-col gap-4 px-4">

@if($quotes)
@foreach($quotes as $quote)
<div class="flex flex-col md:flex-row items-center justify-between gap-4 p-5 bg-white rounded-lg border border-gray-200 shadow-sm transition-all duration-300 glow-border">
<div class="flex flex-col gap-2 w-full">
<p class="text-text-light/80 italic">"{{$quote->content}}"</p>
<div class="flex items-center gap-4 text-sm text-text-light/50">
<span>Créée le: {{$quote->created_at}}</span>
<div class="flex items-center gap-2">
<span class="relative flex h-2 w-2">

@if($quote->is_published >0)
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
<span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
</span>
<span class="font-medium text-green-600">
    Publiée
</span>
@else
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
<span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
</span>
<span class="font-medium text-red-600">
    Brouillon
</span>
@endif
</div>
</div>
</div>
<div class="flex gap-3 self-end md:self-center">

<a href="/delete/{{ $quote->id }}">

    <button class="flex items-center justify-center size-9 rounded-full text-danger-neon/70 hover:bg-danger-neon/10 hover:text-danger-neon transition-colors hover:shadow-glow-danger">
    <span class="material-symbols-outlined text-xl">delete</span>
    </button>
</a>
</div>
</div>
@endforeach
@endif

</div>
</div>
</div>
</main>

@endsection

