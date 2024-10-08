    @extends('layouts.app')
    @section('title', "Gestion des employés")
    @section('contenu')
        <div class="bg-white py-24 sm:py-32">
            <div class="flex justify-center">
                @if (session('success'))
                    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-6 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="sr-only">Check icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal">{{session('success')}}</div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
                <form action="{{ route('modifierEmploye') }}" method="POST">
                    @csrf
                    @method("PATCH")
                    <div class="mx-auto grid max-w-3xl gap-x-8 gap-y-20 px-6 lg:px-8 xl:grid-cols-1">
                        <div class="max-w-2xl">
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Gestion des utilisateurs</h2>
                            <p class="mt-6 text-lg leading-8 text-gray-600">Ajouter, modifier les rôles ou supprimer les employés à partir de cette page.</p>
                        </div>
                    <ul role="list" class="grid gap-x-2 gap-y-2 sm:grid-cols-2 sm:gap-y-2 xl:col-span-2">
                    @if(count($employes))
                        @foreach($employes as $employe)
                            <li class="border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white">
                                <div class="flex items-center gap-x-6">
                                <div>
                                    <h3 class="text-base font-semibold leading-7 text-lg tracking-tight text-gray-900">{{$employe->courriel}}</h3>
                                    <input type="hidden" name="employes[{{ $employe->courriel }}][courriel]" value="{{ $employe->courriel }}">
                                    <select selected="{{$employe->role}}" id="roleSelect" name="employes[{{ $employe->courriel }}][role]" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option value="Administrateur" {{ $employe->role == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
                                        <option value="Responsable" {{ $employe->role == 'Responsable' ? 'selected' : '' }}>Responsable</option>
                                        <option value="Commis" {{ $employe->role == 'Commis' ? 'selected' : '' }}>Commis</option>
                                    </select>
                                </div>
                                </div>
                            </li>
                        @endforeach
                        @else
                            <p>aucun fournisseur</p>
                        @endif
                    </ul>
                    <div class="flex space-x-4">
                        <button class="bg-blue-600 px-4 py-2 rounded-lg text-white hover:bg-blue-500" type="submit">
                            Enregistrer
                        </button>  
                        <a class="bg-blue-600 px-4 py-2 rounded-lg text-white hover:bg-blue-500" href="{{ route('employes.create')}}">Ajouter</a>
                        <button data-modal-target="small-modal" data-modal-toggle="small-modal" class="bg-blue-600 px-4 py-2 rounded-lg text-white hover:bg-blue-500" type="button">
                            Supprimer
                        </button>                
                    </div>
                </form>

                <div id="small-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                Supprimer des utilisateurs
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="small-modal">
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
                                    <input type="text" id="barre-recherche-emp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher">
                                </div>
                            </div>
                            <form action="{{ route('supprimerEmploye') }}" method="POST" id="delete_emp_form">
                                @csrf
                                @method('DELETE')
                                <ul class="liste-employe">
                                @if(count($employes))
                                    @foreach($employes as $employe)
                                    <li class="employe">
                                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <input name="employe[]" type="checkbox" value="{{$employe->courriel}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 checkbox-emp">
                                            <label for="" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{$employe->courriel}}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                @endif
                                </ul>
                            </div>
                            <!-- Modal footer -->
                                <button type="submit" id="supprimerBtn" class="flex items-center p-3 text-sm font-medium text-gray-300 rounded-b-lg dark:border-gray-600 dark:bg-gray-700 dark:text-red-500" disabled onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-6a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2Z"/>
                                    </svg>
                                    Supprimer l'utilisateur(s)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div>
        </div>
    @endsection