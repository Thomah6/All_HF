@extends('layouts.master')

@section('content')

<main class="flex-1 bg-white dark:bg-background-dark/80 p-6 md:p-8 rounded-b-lg">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <a href="/users">
            <button class="bg-black flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 gap-2 text-sm font-bold tracking-wide text-white min-w-0 px-5 neon-gradient neon-glow-hover transition-shadow">
                
                <span class="truncate">Gerer les users</span>
            </button>
        </a>
    </div>
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <p class="text-3xl font-black tracking-tighter text-gray-900 dark:text-white">Gestion des Citations</p>
        <a href="/create">
            <button class="bg-primary flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 gap-2 text-sm font-bold tracking-wide text-white min-w-0 px-5 neon-gradient neon-glow-hover transition-shadow">
                <span class="material-symbols-outlined text-lg">add</span>
                <span class="truncate">Ajouter une Citation</span>
            </button>
        </a>
    </div>
    <div class="flex flex-col md:flex-row justify-between gap-4 mb-4 px-1 py-3 border-y border-gray-200 dark:border-gray-800">

        <div class="flex gap-2">
            <div class="relative group">
                <button class="flex items-center justify-center gap-2 h-10 px-4 rounded-full border border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined text-xl">filter_list</span>
                    <span>Statut</span>
                    <span class="material-symbols-outlined text-sm">expand_more</span>
                </button>
                <div class="absolute overflow-hidden left-0 mt-1 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-10 hidden group-hover:block">
                    <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 {{ !isset($status) ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        Tous les statuts
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'published']) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 {{ isset($status) && $status === 'published' ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        Publiés uniquement
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'unpublished']) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 {{ isset($status) && $status === 'unpublished' ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        Non publiés uniquement
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto @container">
        <div class="border border-gray-200 dark:border-gray-800 rounded-lg">
            <table class="w-full text-left">
                <thead class="border-b border-gray-200 dark:border-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 w-2/5">Citation</th>
                        <th class="table-column-author px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400">Auteur</th>
                        <th class="table-column-source px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400">Source</th>
                        <th class="table-column-status px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400">Statut</th>
                        <th class="table-column-date px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400">Date de Création</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($quotes as $quote)

                    <tr class="border-b border-gray-200 dark:border-gray-800 row-glow-hover transition-all duration-300">

                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $quote->content }}</td>
                        <td class="table-column-author px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{$quote->author}}</td>
                        <td class="table-column-status px-4 py-3">
                            @if($quote->is_published > 0)
                            <div class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300">
                                <div class="size-2 rounded-full bg-green-500"></div>Publiée

                            </div>
                            @elseif($quote->is_published == 0)
                            <div class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300">
                                <div class="size-2 rounded-full bg-red-500"></div>Brouillon
                            </div>
                            @endif
                        </td>
                        <td class="table-column-date px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $quote->created_at }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="/edit/{{ $quote->id }}">
                                    <button class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-white/10 text-gray-500 hover:text-primary transition-colors"><span class="material-symbols-outlined text-xl">edit</span></button>
                                </a>

                                <a href="/delete/{{ $quote->id }}">
                                    <button class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-white/10 text-gray-500 hover:text-red-500 transition-colors"><span class="material-symbols-outlined text-xl">delete</span></button>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    

                </tbody>
            </table>
            <style>
                @container (max-width: 1024px) {
                    .table-column-source {
                        display: none;
                    }
                }

                @container (max-width: 860px) {
                    .table-column-date {
                        display: none;
                    }
                }

                @container (max-width: 768px) {
                    .table-column-author {
                        display: none;
                    }
                }

                @container (max-width: 640px) {
                    .table-column-status {
                        display: none;
                    }
                }
            </style>
        </div>
    </div>

</main>

@endsection
