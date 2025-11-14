@extends('layouts.master')

@section('content')

<main class="mt-8">
    <div class="lg:max-w-[1400px] mx-auto">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Gestion des utilisateurs</h2>
                <p class="text-gray-500 mt-1">Gérez les rôles et permissions des utilisateurs.</p>
            </div>

        </div>
        <div class="mt-8 w-full bg-white/70 backdrop-blur-xl p-6 rounded-lg border border-gray-200/80 shadow-lg shadow-gray-500/5">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="p-4 text-sm font-semibold text-gray-500">Nom</th>
                            <th class="p-4 text-sm font-semibold text-gray-500">Email</th>
                            <th class="p-4 text-sm font-semibold text-gray-500">Rôle</th>
                            <th class="p-4 text-sm font-semibold text-gray-500 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)

                        <tr class="border-b border-gray-200/80 hover:bg-gray-50/50">
                            <td class="p-4 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-300 to-blue-400"></div>
                                    <div>
                                        <div class="font-medium text-gray-800">{{$user->name}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 align-middle text-gray-600"> {{ $user->email }}</td>
                            <td class="p-4 align-middle">
                                
                                <form id="role-form-{{ $user->id }}" action="/edit-role/{{ $user->id }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" onchange="this.form.submit()" class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-purple-100 text-purple-700 ring-1 ring-purple-200">
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="editor" {{ $user->role === 'editor' ? 'selected' : '' }}>Editor</option>
                                        <option value="lector" {{ $user->role === 'lector' ? 'selected' : '' }}>Lector</option>
                                    </select>
                                </form>
                            </td>
                            <td class="p-4 align-middle">
                                <div class="flex justify-end items-center gap-2">
                                    <button class="text-gray-500 hover:text-red-500 transition-colors p-2 rounded-full hover:bg-gray-100"><span class="material-symbols-outlined text-xl">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection