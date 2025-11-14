@extends('layouts.master')
@section('content')

<div class="relative flex h-auto min-h-screen w-full flex-col bg-background-light group/design-root font-display" style='font-family: "Space Grotesk", "sans-serif";'>
<div class="layout-container flex h-full grow flex-col">
<div class="px-4 sm:px-10 md:px-20 lg:px-40 flex flex-1 justify-center py-10 sm:py-20">
<div class="layout-content-container flex flex-col max-w-[720px] flex-1 gap-8">
<!-- Page Heading -->
<div class="flex flex-wrap justify-between gap-3 p-4">
<div class="flex flex-col gap-2">
<h1 class="text-[#212529] text-4xl sm:text-5xl font-bold tracking-tight">Nouvelle Citation</h1>
<p class="text-gray-500 text-lg font-normal">Remplissez les champs ci-dessous pour ajouter une nouvelle citation.</p>
</div>
</div>
<!-- Form Fields -->
<div class="flex flex-col gap-8 px-4">
    <form action="/create/store" method="post">
        @csrf
<!-- Textarea for Quote -->
<label class="flex flex-col w-full">
<p class="text-[#212529] text-base font-medium leading-normal pb-2">Citation</p>
<div class="rounded-xl form-input-neon">
<textarea name="content" class="border border-gray-200 form-input flex w-full min-w-0 flex-1 resize-y overflow-hidden rounded-xl bg-transparent text-[#212529] focus:outline-0 focus:ring-0 border-none min-h-36 placeholder:text-gray-400 p-[15px] text-base font-normal leading-normal" placeholder="Saisissez ici la citation..."></textarea>
</div>
</label>
<!-- Input for Author -->
<label class="flex flex-col w-full">
<p class="text-[#212529] text-base font-medium leading-normal pb-2">Auteur</p>
<div class="rounded-xl form-input-neon">
<input name="author" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl bg-transparent text-[#212529] focus:outline-0 focus:ring-0 border-none h-14 placeholder:text-gray-400 p-[15px] text-base font-normal leading-normal" placeholder="Nom de l'auteur" value=""/>
</div>
</label>
</div>
<!-- Action Panel for Status (Admin Only) -->
 @if($user->id=="admin")
<div class="p-4 @container">
<div class="flex flex-1 flex-col items-start justify-between gap-4 rounded-xl border border-gray-200 bg-white p-5 @[480px]:flex-row @[480px]:items-center">
<div class="flex flex-col gap-1">
<p class="text-[#212529] text-base font-bold leading-tight">Statut</p>
<p class="text-gray-500 text-base font-normal leading-normal">Brouillon / Publiée</p>
</div>
<label class="relative flex  cursor-pointer items-center rounded-full p-0.5 bg-gray-200">
<input class="" name="is_published" type="checkbox"/>
</label>
</div>
</div>
@endif
<!-- Button Group -->
<div class="flex justify-stretch">
<div class="flex flex-1 gap-4 flex-wrap px-4 py-3 justify-end">
<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 px-6 btn-outline-neon">
<span class="truncate text-base font-bold tracking-wider">Annuler</span>
</button>
<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 px-6 bg-gradient-to-r from-[#EC008C] to-[#007BFF] text-white text-base font-bold tracking-wider btn-glow">
<span class="truncate">Enregistrer</span>
</button>

</form>
</div>
</div>
<!-- Feedback Message (Success Example) -->
<!--  
<div class="px-4 py-3">
<div class="flex items-center gap-4 rounded-xl border border-green-200 bg-green-50 p-4">
<span class="material-symbols-outlined text-green-600">check_circle</span>
<p class="text-green-800 text-sm font-medium">Citation enregistrée avec succès !</p>
</div>
</div> -->

<!-- Feedback Message (Error Example) -->
<!-- <div class="px-4 py-3">
<div class="flex items-center gap-4 rounded-xl border border-red-200 bg-red-50 p-4">
<span class="material-symbols-outlined text-red-600">error</span>
<p class="text-red-800 text-sm font-medium">Le champ "Citation" ne peut pas être vide.</p>
</div>
</div> -->


</div>
</div>
</div>
</div>

@endsection