@extends('app')

@section('content')
    @include('partials/header')

    <div class="container mx-auto mt-6 flex">

        <!-- Sidebar -->
        @include('partials/aside')

        <!-- Contenu principal -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6 ml-6">
            @if(session()->has('enregistrement_compte'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                     role="alert">
                    <span class="font-medium">{{ session()->get('enregistrement_compte') }}</span>
                </div>
            @endif

            @if(session()->has('supprimer_contact'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                     role="alert">
                    <span class="font-medium">{{ session()->get('supprimer_contact') }}</span>
                </div>
            @endif

            @if(session()->has('ajouter_contact'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                     role="alert">
                    <span class="font-medium">{{ session()->get('ajouter_contact') }}</span>
                </div>
            @endif

            @if(session()->has('ajouter_finance'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                     role="alert">
                    <span class="font-medium">{{ session()->get('ajouter_finance') }}</span>
                </div>
            @endif
            <!-- Message de mise a jour des finances -->

            @if(auth()->user()->numTPS==null and auth()->user()->numTVQ==null and auth()->user()->etatDemande=="Acceptée")
                <div id="alert-border-4"
                     class="flex items-center p-4 mb-4 text-yellow-800 border-t-4 border-yellow-300 bg-yellow-50 dark:text-yellow-300 dark:bg-gray-800 dark:border-yellow-800"
                     role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        Ajouter les données de finances <a href="{{ route('profil.create_finance') }}"
                                                           class="font-semibold underline hover:no-underline">ici</a>
                    </div>
                </div>
            @endif
            <!--  Fin de mise a jour des finances -->
            <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">Ma fiche fournisseur</h1>
            <div class="flex justify-evenly">
                <div class="mx-1 w-1/3">
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Statut de la demande</legend>
                        <p class="text-gray-800">
                            @if(auth()->user()->etatDemande=="En attente")
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{ auth()->user()->etatDemande }}</span>
                            @elseif(auth()->user()->etatDemande=="Acceptée")
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ auth()->user()->etatDemande }}</span>
                            @elseif(auth()->user()->etatDemande=="À réviser")
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ auth()->user()->etatDemande }}</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{ auth()->user()->etatDemande }}</span>
                            @endif
                        </p>
                    </fieldset>

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Identification</legend>
                        <p class="text-gray-800">{{ auth::user()->neq }}</p>
                        <p class="text-gray-800">{{ auth::user()->nomEntreprise }}</p>
                        <p class="text-gray-800">{{ auth::user()->email }}</p>
                    </fieldset>

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Contacts</legend>
                        <a href="{{ route('profil.create_contact') }}">
                            <i class="text-right fa-solid fa-plus bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"></i>
                        </a>
                        @foreach(auth::user()->contacts as $contact)
                            <div class="flex justify-around">
                                <div class="flex items-center justify-center">
                                    <i class="fa-solid fa-address-book text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800">{{ $contact->nom }}, {{ $contact->prenom }}</p>
                                    <p class="text-gray-800">{{ $contact->fonction }}</p>
                                    <p class="text-gray-800">{{ $contact->courriel }}</p>
                                    <p class="text-gray-800">{{ $contact->numTelephone }} #{{ $contact->poste }}</p>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="flex items-center justify-center"><a
                                            class="px-2 py-2 bg-blue-300 rounded-lg fa-regular fa-pen-to-square text-blue-500 hover:text-blue-800 text-xl"
                                            href="{{ route('create_contact',$contact->id) }}"></a></span>
                                    <span data-modal-target="supprimer-contact{{$contact->id}}"
                                          data-modal-toggle="supprimer-contact{{$contact->id}}"
                                          class="flex items-center justify-center">
                                        <a onclick="event.preventDefault();"
                                           class="px-2 py-2 bg-red-300 rounded-lg fa-regular fa-trash-can text-red-500 hover:text-red-800 text-xl"
                                           href="#"></a>
                                        <form action="{{ route('supprimer-contact',$contact->id) }}" method="post"
                                              id="form_supprimer_contact{{$contact->id}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </span>

                                    <!-- modal de suppresssion de contact -->
                                    <div id="supprimer-contact{{$contact->id}}" tabindex="-1"
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
                                                        Voulez-vous vraimer supprimer ce contact?</h3>
                                                    <button
                                                        onclick="event.preventDefault(); document.getElementById('form_supprimer_contact{{$contact->id}}').submit();"
                                                        data-modal-hide="supprimer-contact" type="button"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Supprimer
                                                    </button>
                                                    <button
                                                        data-modal-hide="supprimer-contact{{$contact->id}}"
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
                            <hr class="border-0 h-1 bg-blue-600 my-2">
                        @endforeach
                    </fieldset>

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Adresse</legend>
                        <div class="text-right">
                            <a href="{{ route('create_coordonnee',auth()->user()->id) }}" class="text-blue-600 hover:text-blue-900"><i
                                    class="text-xl fa-regular fa-pen-to-square"></i></a>
                        </div>
                        <p class="text-gray-800 my-1">{{ auth::user()->numCivique }}
                            , {{ auth::user()->rue }}</p>
                        <p class="text-gray-800 my-1">{{trim( auth::user()->ville,'"') }}
                            ({{ auth::user()->province }}) {{ auth::user()->codePostal }}</p>
                        <p class="text-gray-800 my-1"><a target="_blank"
                                                         href="{{ auth::user()->siteInternet }}">{{ auth::user()->siteInternet }}</a>
                        </p>
                        @for($i=0;$i<count(auth::user()->numeroTelephone);$i++)
                            <p class="text-gray-800 my1">
                                @if(auth::user()->typeNumTelephone[$i]=="Telecopieur")
                                    <i class="fa-solid fa-fax mr-2"></i>
                                @elseif(auth::user()->typeNumTelephone[$i]=="Cellulaire")
                                    <i class="fa-solid fa-phone mr-2"></i>
                                @else
                                    <i class="fa-solid fa-desktop mr-2"></i>
                                @endif
                                {{ auth::user()->numeroTelephone[$i] }} #{{ auth::user()->poste[$i] }}</p>
                        @endfor
                    </fieldset>
                </div>

                <div class="mx-1 w-1/3">

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Produits et services offerts
                        </legend>
                        <div class="text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-900"><i
                                    class="text-xl fa-regular fa-pen-to-square"></i></a>
                        </div>
                        @php
                            $categories = [];
                            // Organiser les produits par catégorie et sous-catégorie
                            foreach (auth()->user()->service->produit_services as $service) {
                                $valeurs = explode('/', $service);

                                // Structurer les catégories et sous-catégories sans répétition
                                $categorie = $valeurs[0] ?? '';
                                $sousCategorie = $valeurs[1] ?? '';
                                $element = $valeurs[2] ?? '';
                                $sousElement = $valeurs[3] ?? '';

                                if (!isset($categories[$categorie])) {
                                    $categories[$categorie] = [];
                                }
                                if (!isset($categories[$categorie][$sousCategorie])) {
                                    $categories[$categorie][$sousCategorie] = [];
                                }
                                $categories[$categorie][$sousCategorie][] = [$element, $sousElement];
                            }
                        @endphp

                        {{-- Affichage structuré en Blade --}}
                        @foreach($categories as $categorie => $sousCategories)
                            <ul>
                                <li>{{ $categorie }}</li>
                                @foreach($sousCategories as $sousCategorie => $elements)
                                    <ul class="ml-3">
                                        <li>{{ $sousCategorie }}</li>
                                        @foreach($elements as [$element, $sousElement])
                                            <ul class="ml-6">
                                                <li>{{ $element }} - {{ $sousElement }}</li>
                                            </ul>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </ul>
                        @endforeach


                        <hr class="border-0 h-1 bg-blue-600 my-2">
                        <h2><strong>Détails</strong></h2>
                        <p>
                            {{ auth()->user()->service->details }}
                        </p>
                    </fieldset>
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Brochures et cartes
                            d'affaire
                        </legend>
                        <p class="text-gray-800">
                        <ul>
                            @foreach(auth()->user()->brochures as $brochure)
                                <li class="flex items-center justify-around mb-2">
                                    <a href="{{ asset('storage/brochures/'.$brochure->nom) }}"
                                       download="{{ $brochure->nom }}">
                                        @php
                                            // Déterminer l'extension du fichier
                                            $extension = pathinfo($brochure->nom, PATHINFO_EXTENSION);
                                            // Définir la classe d'icône et la couleur en fonction de l'extension
                                            switch ($extension) {
                                                case 'pdf':
                                                    $iconClass = 'fa-regular fa-file-pdf text-red-500'; // Couleur rouge pour PDF
                                                    break;
                                                case 'doc':
                                                case 'docx':
                                                    $iconClass = 'fa-regular fa-file-word text-blue-500'; // Couleur bleue pour Word
                                                    break;
                                                case 'xls':
                                                case 'xlsx':
                                                    $iconClass = 'fa-regular fa-file-excel text-green-500'; // Couleur verte pour Excel
                                                    break;
                                                case 'ppt':
                                                case 'pptx':
                                                    $iconClass = 'fa-regular fa-file-powerpoint text-orange-500'; // Couleur orange pour PowerPoint
                                                    break;
                                                default:
                                                    $iconClass = 'fa-regular fa-file text-gray-500'; // Couleur par défaut
                                            }
                                        @endphp

                                        <i class="{{ $iconClass }} mr-2"></i>
                                        {{ $brochure->type }}
                                    </a>
                                    <span class="ml-2">{{ number_format(Storage::size('public/brochures/' . $brochure->nom) / 1024, 2) }} Ko</span>
                                    <span>{{ $brochure->created_at->format('d-m-y') }}</span>
                                </li>
                            @endforeach

                        </ul>
                        </p>
                    </fieldset>
                </div>
                @if(auth()->user()->numTPS!=null and auth()->user()->numTVQ!=null and auth()->user()->etatDemande=="Acceptée")
                    <div class="mx-1 w-1/3">
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Finances</legend>
                        <div class="text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-900"><i
                                    class="text-xl fa-regular fa-pen-to-square"></i></a>
                        </div>
                        <p class="text-gray-800 tems-center justify-center">
                        <p>
                            <span class="font-medium">TPS </span> {{ auth::user()->numTPS }}
                        </p>
                        <p class="my-1">
                            <span class="font-medium">TVQ </span> {{ auth::user()->numTVQ }}
                        </p>
                        <p class="my-1">
                            <span class="font-medium">condition de paiement</span><br>
                            {{ auth::user()->conditionPaiement }}
                        </p>
                        <p class="my-1">
                            <span class="font-medium">Devise</span><br>
                            {{ auth::user()->devise }}
                        </p>
                        <p class="my-1">
                            <span class="font-medium">Mode de communication</span><br>
                            {{ auth::user()->modeCommunication}}
                        </p>
                        </p>
                    </fieldset>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection


