@extends('layouts.app')
    @section('title', "Gestion des employés")
    
    @section('contenu')
        <div class="bg-white py-10 sm:py-10">
            <div class="flex justify-center">
                <div class="mb-5">
                    <div>
                        <ul class="hidden mb-5 text-sm font-medium text-center text-gray-500 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
                            <li class="w-40 focus-within:z-10">
                                <a href="#" class="inline-block w-full p-4 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 rounded-s-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none dark:bg-gray-700 dark:text-white">Modèle de courriel</a>
                            </li>
                            <li class="w-40 focus-within:z-10">
                                <a href="{{ route('parametre')}}" class="inline-block w-full p-4 bg-white border-s-0 border-gray-200 dark:border-gray-700 rounded-e-lg hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Paramètres</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="items-center flex justify-center grid grid-cols-3">
                <form method="post" action="{{ route('modifierCourriel') }}" class="px-8 mb-4 col-start-2">
                    @csrf
                    @method('PATCH')
                        <h1 class="font-bold text-2xl mb-5">Modèle de courriel</h1>
                        @if($courriels)
                            @foreach($courriels as $courriel)
                                <label for="objet" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Objet</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100" name="objet" id="objet" type="text" placeholder="Objet" value="{{$courriel->objet}}">
                                @error('objet')
                                    <div class="mb-5 mt-2 text-red-500">{{ $message }}</div>
                                @enderror
                                
                                <label for="message" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                                <textarea name="message" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100" placeholder="Message à envoyer...">{{$courriel->message}}</textarea>

                                @error('message')
                                    <div class="mb-5 mt-2 text-red-500">{{ $message }}</div>
                                @enderror

                                <label for="modele" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Type de courriel</label>
                                <div class="grid grid-cols-8 flex space-around">
                                    <select name="role" id="choixRole" class="col-span-4 block appearance-none w-full bg-white px-4 py-2 border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100">
                                        <option value="">Choisissez un type</option>
                                        @if(count($roleCourriels))
                                            @foreach($roleCourriels as $roleCourriel)
                                                <option value="{{ $roleCourriel->role }}" class="roleCourriel" >{{$roleCourriel->role}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    <button type="button" data-modal-target="small-modal" data-modal-toggle="small-modal" class="col-start-5 col-span-2 mx-2 text-sm appearance-none bg-white py-2 border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100">
                                        Ajouter
                                    </button>
                                    <button type="button" data-modal-target="large-modal" data-modal-toggle="large-modal" class="col-start-7 col-span-2 mx-1 text-sm appearance-none bg-white py-2 border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100">
                                        Supprimer
                                    </button>
                                    @error('role')
                                        <div class="mb-5 mt-2 w-max text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>    
                                <div id="champRefus" style="display: none;">
                                    <label for="raison" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Raison</label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100" name="raison" id="raison" type="text" placeholder="Raison du refus (optionnel)" value="">
                                </div>

                                <button type="submit" class="mt-8 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-4">
                                    Enregistrer les modifications 
                                </button>
                                @if (session('success'))
                                            <div id="toast-success" class="flex items-center text-gray-500" role="alert">
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

                <!-- modal pour l'ajout de role -->
                <div id="small-modal" tabindex="-1" aria-hidden="true" class="fixed overflow-y-auto overflow-x-hidden hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Ajouter un rôle
                                </h3>
                            </div>
                            <!-- Modal body -->
                            <form class="p-4 md:p-5" method="post" action="{{ route('employes.storeCourrielRole') }}">
                                @csrf
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rôle</label>
                                        <input type="text" name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nom du rôle">
                                    </div>
                                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    Ajouter le rôle
                                </button>
                            </form>
                        </div>
                    </div>
                </div> 

                <!-- modal pour la suppression de role --> 
                </div>
                <div id="large-modal" tabindex="-1" class="fixed hidden inset-0 flex items-center justify-center z-50">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                    Supprimer des rôles
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Fermer le modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <div class="p-1">
                                    <label for="input-group-search" class="sr-only">Rechercher</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </div>
                                        <input type="text" id="barre-recherche-roleCourriel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher">
                                    </div>
                                </div>
                                <form action="{{ route('supprimerRoleCourriel') }}" method="POST" id="delete_roleCourriel_form">
                                    @csrf
                                    @method('DELETE')
                                    <ul class="liste-roleCourriel">
                                    @if(count($roleCourriels))
                                        @foreach($roleCourriels as $roleCourriel)
                                        <li class="roleCourriel">
                                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input name="roleCourriel[]" type="checkbox" value="{{$roleCourriel->role}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 checkbox-emp">
                                                <label for="" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{$roleCourriel->role}}</label>
                                            </div>
                                        </li>
                                        @endforeach
                                    @endif
                                    </ul>
                                    <!-- Modal footer -->
                                    <button type="submit" id="supprimerBtn" class="flex items-center p-3 text-sm font-medium text-gray-300 rounded-b-lg dark:border-gray-600 dark:bg-gray-700 dark:text-red-500" disabled onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce(s) rôle(s) ?');">
                                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-6a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2Z"/>
                                        </svg>
                                        Supprimer le(s) rôle(s)
                                    </button>
                                </form>
                            </div>
                        </div>
                </div>

            </div>

        </div>

        <div>
        </div>
    @endsection