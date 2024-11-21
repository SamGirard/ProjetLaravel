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

                <button data-modal-target="supprimer-profil"
                        data-modal-toggle="supprimer-profil"
                        class="bg-transparent border-2 border-red-500 text-red-500 font-medium px-5 py-2 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-300 ease-in-out shadow-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50">
                    Retirer ma fiche
                </button>

                <!-- modal de suppresssion de sa fiche -->
                <div id="supprimer-profil" tabindex="-1"
                     data-modal-backdrop="static"
                     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="popup-modal">
                                <svg class="w-3 h-3" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-width="2"
                                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-width="2"
                                          d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                    Entrer le mot de passe pour supprimer?</h3>
                                <form action="{{ route('profile.destroy') }}" class="font-bold text-gray-900 pt-4 mb-3"
                                      id="form_supprimer_profil" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="flex">
                                        <input type="password" name="password" id="password"
                                               class="@error('password') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                               placeholder="......." required/>
                                        @error('password')
                                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                        @enderror
                                    </div>
                                    @error('password')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </form>
                                <button onclick="document.getElementById('form_supprimer_profil').submit();"
                                        data-modal-hide="supprimer-profil" type="button"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Supprimer
                                </button>
                                <button
                                    data-modal-hide="supprimer-profil"
                                    type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        var element = document.getElementById('supprimer-profil');
        console.log(element);
        @error('password')
            element.classList.remove('hidden');
        @enderror
    </script>
@endsection
