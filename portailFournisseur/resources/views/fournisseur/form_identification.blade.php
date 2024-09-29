@extends('app')
@section('content')
    @include('partials/header')
    @include('partials/barre_ajout')

    <div class="container mx-auto mt-6">
        <form action="{{ route('store_identification') }}" method="post" class="bg-white shadow-xl rounded-xl px-10 py-8 mb-8 transition-all hover:shadow-2xl duration-300 ease-in-out">
            @csrf
            <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">Identification</h1>

            <div class="grid grid-cols-2 gap-8">
                <!-- Colonne 1 -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="mb-8">
                        <label for="neq" class="block text-lg text-gray-600 mb-2">NEQ</label>
                        <div class="relative">
                            <input required
                                   class="shadow-sm appearance-none border @error('neq') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                   id="neq" name="neq" type="text" placeholder="1164568745" value="{{ old('neq') }}">
                            @error('neq')
                            <i class="fa-solid fa-circle-xmark absolute right-4 top-1/2 transform -translate-y-1/2 text-red-500"></i>
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-8">
                        <label for="nom" class="block text-lg text-gray-600 mb-2">Nom de l'entreprise</label>
                        <div class="relative">
                            <input required
                                   class="shadow-sm appearance-none border @error('nom') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                   id="nom" name="nom" type="text" value="{{ old('nom') }}">
                            @error('nom')
                            <i class="fa-solid fa-circle-xmark absolute right-4 top-1/2 transform -translate-y-1/2 text-red-500"></i>
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Colonne 2 -->
                <div>
                    <fieldset class="border border-gray-200 rounded-lg p-6 bg-gray-50">
                        <legend class="text-lg font-semibold text-gray-800 mb-4">Authentification</legend>

                        <div class="mb-8">
                            <label for="email" class="block text-lg text-gray-600 mb-2">Adresse courriel</label>
                            <div class="relative">
                                <input class="shadow-sm appearance-none border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       id="email" name="email" type="email" value="{{ old('email') }}">
                                @error('email')
                                <i class="fa-solid fa-circle-xmark absolute right-4 top-1/2 transform -translate-y-1/2 text-red-500"></i>
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-8">
                            <label for="password" class="block text-lg text-gray-600 mb-2">Mot de passe</label>
                            <div class="relative">
                                <input class="shadow-sm appearance-none border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       id="password" name="password" type="password" autocomplete="new-password">
                                @error('password')
                                <i class="fa-solid fa-circle-xmark absolute right-4 top-1/2 transform -translate-y-1/2 text-red-500"></i>
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-8">
                            <label for="password_confirmation" class="block text-lg text-gray-600 mb-2">Confirmer le mot de passe</label>
                            <div class="relative">
                                <input id="password_confirmation"
                                       class="shadow-sm appearance-none border @error('password_confirmation') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       name="password_confirmation" required autocomplete="new-password" type="password">
                                @error('password_confirmation')
                                <i class="fa-solid fa-circle-xmark absolute right-4 top-1/2 transform -translate-y-1/2 text-red-500"></i>
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="flex justify-end mt-10">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105" type="submit">
                    Suivant
                </button>
            </div>
        </form>
    </div>
@endsection
