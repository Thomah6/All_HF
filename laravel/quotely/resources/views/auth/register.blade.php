@extends('layouts.master');

@section('content')

<div class="relative flex h-auto mt-xl w-full flex-col items-center justify-center bg-background-light p-4 group/design-root overflow-x-hidden">
<div class="absolute inset-0 z-0 opacity-20 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-primary/20 via-transparent to-transparent"></div>
<div class="absolute inset-0 z-0 opacity-30 bg-[radial-gradient(ellipse_at_bottom,_var(--tw-gradient-stops))] from-[#00FFFF]/10 via-transparent to-transparent"></div>
<div class="layout-container flex h-full grow flex-col justify-center items-center w-full z-10">
<div class="layout-content-container flex flex-col w-full max-w-md">

<div class="w-full bg-white/70 backdrop-blur-md p-8 rounded-lg border border-gray-200/80 shadow-xl shadow-gray-200/50">
<div class="flex w-full mb-8">
<div class="flex h-12 flex-1 items-center justify-center rounded-full bg-gray-100 p-1.5">
<label class="flex cursor-pointer h-full grow items-center justify-center overflow-hidden rounded-full px-2 has-[:checked]:bg-gradient-to-r has-[:checked]:from-[#00FFFF] has-[:checked]:to-[#FF00FF] has-[:checked]:shadow-glow-cyan-magenta text-gray-600 has-[:checked]:text-white text-sm font-bold leading-normal transition-all duration-300">
<span class="truncate">Inscription</span>
<input checked="" class="invisible w-0" name="auth-toggle" type="radio" value="Connexion"/>
</label>

</div>
</div>
<form action="/register/save" method="post" class="flex flex-col gap-6">
@csrf
<div class="flex flex-col">
<label class="flex flex-col w-full">
<p class="text-gray-700 text-base font-medium leading-normal pb-2">Nom</p>
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded text-gray-800 focus:outline-0 focus:ring-0 border border-gray-300 bg-white h-14 placeholder:text-gray-400 p-[15px] text-base font-normal leading-normal transition-all duration-300 focus:border-primary focus:shadow-[0_0_8px_rgba(106,37,244,0.3)]" placeholder="Entrez votre nom" name="name" type="text" value=""/>
</label>
</div>
<div class="flex flex-col">
<label class="flex flex-col w-full">
<p class="text-gray-700 text-base font-medium leading-normal pb-2">Adresse e-mail</p>
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded text-gray-800 focus:outline-0 focus:ring-0 border border-gray-300 bg-white h-14 placeholder:text-gray-400 p-[15px] text-base font-normal leading-normal transition-all duration-300 focus:border-primary focus:shadow-[0_0_8px_rgba(106,37,244,0.3)]" placeholder="Entrez votre e-mail" name="email" type="email" value=""/>
</label>
</div>

<div class="flex flex-col">
<label class="flex flex-col w-full">
<p class="text-gray-700 text-base font-medium leading-normal pb-2">Mot de passe</p>
<div class="flex w-full flex-1 items-stretch rounded form-input-neon transition-all duration-300">
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-l text-gray-800 focus:outline-0 focus:ring-0 border border-gray-300 bg-white h-14 placeholder:text-gray-400 p-[15px] border-r-0 pr-2 text-base font-normal leading-normal" placeholder="Entrez votre mot de passe" type="password" name="password" value=""/>
<div class="text-gray-400 flex border border-gray-300 bg-white items-center justify-center px-4 rounded-r border-l-0">
<span class="material-symbols-outlined" style="font-size: 24px;">visibility</span>
</div>
</div>
</label>

</div>
<button class="flex items-center justify-center text-center font-bold text-base leading-normal text-white bg-gray-700 rounded-full h-14 w-full mt-4 shadow-glow-cyan-magenta hover:shadow-glow-cyan-magenta-lg transition-shadow duration-300" type="submit">S'inscrire</button>
</form>
</div>
</div>
</div>
</div>

@endsection