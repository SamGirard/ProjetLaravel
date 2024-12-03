@extends('app')
@section('content')
    @include('partials/header')

    <div class="mx-10">

        <form method="POST" action="{{ route('login') }}" class="border border-gray-200 rounded-lg p-6 bg-gray-50 mt-10 mb-2 mx-10">
            @csrf
            <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">Connexion</h1>

            <!-- Identifier Field -->
            <div class="mb-8" id="identifierField">
                <label for="identifier" class="block text-lg text-gray-600 mb-2">Adresse courriel ou NEQ</label>
                <div class="relative">
                    <input class="shadow-sm appearance-none border @error('identifier') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                           id="identifier" name="identifier" type="text" value="{{ old('identifier') }}">
                    @error('identifier')
                    <i class="fa-solid fa-circle-xmark absolute right-4 top-1/2 transform -translate-y-1/2 text-red-500"></i>
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Password -->
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

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">Se souvenir de moi!</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        Mot de passe oublié?
                    </a>
                @endif

                <button class=" ml-3 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105" type="submit">
                    Se connecter
                </button>
            </div>
        </form>
    </div>
    @include('partials/footer')
@endsection
