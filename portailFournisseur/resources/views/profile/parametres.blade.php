@extends('app')

@section('content')
    @include('partials/header')

    <div class="container mx-auto mt-6 flex">

        <!-- Sidebar -->
        @include('partials/aside')

        <!-- Contenu principal -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6 ml-6">
            @if(session()->has('status'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                     role="alert">
                    <span class="font-medium">{{ session()->get('status') }}</span>
                </div>
            @endif
            <h1 class="text-3xl font-bold text-gray-900 mb-1 border-b-2 border-gray-300 pb-4">Paramètres</h1>
            <div class="container mx-auto">
                <form action="{{ route('password.update') }}" method="post"
                      class="bg-white shadow-md rounded px-6 pt-6 pb-8 mb-4">
                    @csrf
                    @method('PUT')
                    <fieldset class="border border-gray-200 rounded-lg p-6">
                        <legend class="font-semibold text-gray-800 mb-4">Modifier le mot de passe</legend>

                        <!-- Mot de passe actuel -->
                        <div class="mb-4">
                            <label for="ancien_password" class="block text-lg text-gray-600 mb-2">Mot de passe
                                actuel</label>
                            <div class="flex">
                                <input required
                                       class="@error('ancien_password') border-red-500 @else border-gray-300 @enderror shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       id="ancien_password" name="ancien_password" type="password">
                                @error('ancien_password')
                                <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                @enderror
                            </div>
                            @error('ancien_password')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nouveau mot de passe -->
                        <div class="mb-4">
                            <label for="nouveau_password" class="block text-lg text-gray-600 mb-2">Nouveau mot de
                                passe</label>
                            <div class="flex">
                                <input required
                                       class="@error('nouveau_password') border-red-500 @else border-gray-300 @enderror shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       id="nouveau_password" name="nouveau_password" type="password">
                                @error('nouveau_password')
                                <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                @enderror
                            </div>
                            @error('nouveau_password')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirmation du nouveau mot de passe -->
                        <div class="mb-4">
                            <label for="nouveau_password_confirmation" class="block text-lg text-gray-600 mb-2">Confirmer
                                le nouveau mot de passe</label>
                            <div class="flex">
                                <input required
                                       class="border-gray-300 shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       id="nouveau_password_confirmation" name="nouveau_password_confirmation"
                                       type="password">

                            </div>
                        </div>

                    </fieldset>

                    <!-- Bouton de soumission -->
                    <div class="text-right mt-2">
                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105"
                            type="submit">
                            Modifier
                        </button>
                    </div>
                </form>

                <hr>
                <form action="" class="font-bold text-gray-900 mt-1 border-t-2 border-gray-300 pt-4">
                    <button
                        class="bg-transparent border-2 border-red-500 text-red-500 font-medium px-5 py-2 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-300 ease-in-out shadow-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50">
                        Retirer ma fiche
                    </button>
                </form>

            </div>

        </div>
    </div>

@endsection

@section('scripts')

@endsection
