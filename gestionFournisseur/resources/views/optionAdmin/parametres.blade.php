@extends('layouts.app')
    @section('title', "Paramètres")
    
    @section('contenu')
        <div class="bg-white py-10 sm:py-10">
            <div class="flex justify-center">
                <div class="mb-8">
                    <ul class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
                        <li class="w-40 focus-within:z-10">
                            <a href="{{ route('modeleCourriel')}}" class="inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 rounded-s-lg hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 active focus:outline-none dark:bg-gray-700 dark:text-white">Modèle de courriel</a>
                        </li>
                        <li class="w-40 focus-within:z-10">
                            <a href="#" class="inline-block w-full p-4 text-gray-900 bg-gray-100 border-gray-200 dark:border-gray-700 rounded-e-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Paramètres</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="items-center flex justify-center grid grid-cols-3">
                <form method="POST" action="{{ route('modifierParam') }}" class="px-8 mb-4 col-start-2">
                        @method('PATCH')
                        @csrf
                        <h1 class="font-bold text-2xl mb-5">Gestion des paramètres</h1>
                        @if($parametres)
                            @foreach($parametres as $parametre)
                                    <label for="courrielAppro" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Courriel de l'Approvisionnement</label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100" name="courrielAppro" value="{{ $parametre->courrielAppro }}" id="courrielAppro" type="text">
                                    @error('courrielAppro')
                                        <div class="mb-5 mt-2 text-red-500">{{ $message }}</div>
                                    @enderror
                                    
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="col-span-2">
                                            <label for="delai" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Délai avant la révision (mois)</label>
                                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100" name="delai" value="{{ $parametre->delaiRevision }}" id="delai" type="number">
                                            @error('delai')
                                                <div class="mb-5 mt-2 text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-start-3 col-span-2">
                                            <label for="taille" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Taille maximale des fichiers joints (Mo)</label>
                                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100" name="taille" value="{{ $parametre->tailleMaxFichiers }}"  id="taille" type="number">
                                            @error('taille')
                                                <div class="mb-5 mt-2 text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <label for="courrielFinance" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Courriel des Finances</label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100" name="courrielFinance"  value="{{ $parametre->courrielFinance }}"  id="courrielFin" type="text">
                                    @error('courrielFinance')
                                        <div class="mb-5 mt-2 text-red-500">{{ $message }}</div>
                                    @enderror
                                    <div class="flex align-items-center">
                                        <button type="submit" class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-4">
                                            Enregistrer les modifications 
                                        </button>
                                        @if (session('success'))
                                            <div id="toast-success" class="flex items-center p-4 text-gray-500" role="alert">
                                                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 dark:bg-green-800 dark:text-green-200">
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                                    </svg>
                                                    <span class="sr-only">Check icon</span>
                                                </div>
                                                <div class="ms-3 text-sm font-normal">{{session('success')}}</div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach  
                        @endif          
                </form>
            </div>
        </div>

        <div>
        </div>
    @endsection