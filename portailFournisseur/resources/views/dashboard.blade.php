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
            <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">Ma fiche fournisseur</h1>
            <div class="flex justify-evenly">
                <div class="mx-1">
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Statut de la demande</legend>
                        <p class="text-gray-800">
                            @if(auth()->user()->statut==0)
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">En attente</span>
                            @elseif(auth()->user()->statut==1)
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Accepté</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">Refusé</span>
                            @endif
                        </p>
                    </fieldset>
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Identification</legend>
                        <p class="text-gray-800">{{ Auth::user()->neq }}</p>
                        <p class="text-gray-800">{{ Auth::user()->nomEntreprise }}</p>
                        <p class="text-gray-800">{{ Auth::user()->email }}</p>
                    </fieldset>
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Contacts</legend>
                        <div class="text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="text-xl fa-regular fa-pen-to-square"></i></a>
                        </div>
                        @foreach(Auth::user()->contacts as $contact)
                            <div class="flex justify-between">
                                <div>
                                    <i class="fa-solid fa-address-book text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800">{{ Auth::user()->neq }}</p>
                                    <p class="text-gray-800">{{ Auth::user()->nomEntreprise }}</p>
                                    <p class="text-gray-800">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <hr class="border-0 h-1 bg-blue-600 my-2">
                        @endforeach
                    </fieldset>
                </div>

                <div class="mx-1">
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Adresse</legend>
                        <div class="text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="text-xl fa-regular fa-pen-to-square"></i></a>
                        </div>
                        <p class="text-gray-800 my-1">{{ Auth::user()->coordonnee->numCivique }}
                            , {{ Auth::user()->coordonnee->rue }}</p>
                        <p class="text-gray-800 my-1">{{ Auth::user()->coordonnee->ville }}
                            ({{ Auth::user()->coordonnee->province }}) {{ Auth::user()->coordonnee->codePostal }}</p>
                        <p class="text-gray-800 my-1"><a target="_blank"
                                                         href="{{ Auth::user()->coordonnee->siteInternet }}">{{ Auth::user()->coordonnee->siteInternet }}</a>
                        </p>
                        @for($i=0;$i<count(Auth::user()->numeroTelephone);$i++)
                            <p class="text-gray-800 my1">
                                @if(Auth::user()->typeNumTelephone[$i]=="Telecopieur")
                                    <i class="fa-solid fa-fax mr-2"></i>
                                @elseif(Auth::user()->typeNumTelephone[$i]=="Cellulaire")
                                    <i class="fa-solid fa-phone mr-2"></i>
                                @else
                                    <i class="fa-solid fa-desktop mr-2"></i>
                                @endif
                                {{ Auth::user()->numeroTelephone[$i] }} #{{ Auth::user()->poste[$i] }}</p>
                        @endfor
                    </fieldset>

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Produits et services offerts
                        </legend>
                        <div class="text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="text-xl fa-regular fa-pen-to-square"></i></a>
                        </div>
                        @foreach(auth()->user()->service->produit_services as $service)
                            @php
                                // Séparer la chaîne par les "/"
                                $valeurs = explode('/', $service);
                            @endphp

                            <ul>
                                <li class="">{{ $valeurs[0] ?? '' }}
                                    @if(isset($valeurs[1]))
                                        <ul>
                                            <li class="ml-3">{{ $valeurs[1] }}
                                                @if(isset($valeurs[2]))
                                                    <ul>
                                                        <li class="ml-3">{{ $valeurs[2] }} - {{ $valeurs[3] ?? '' }}</li>
                                                    </ul>
                                                @endif
                                            </li>
                                        </ul>
                                    @endif
                                </li>
                            </ul>
                        @endforeach

                        <hr class="border-0 h-1 bg-blue-600 my-2">
                        <h2>Détails</h2>
                        <p>
                            {{ auth()->user()->service->details }}
                        </p>

                    </fieldset>

                </div>

                <div class="mx-1">
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Produits et services offerts
                        </legend>
                        @foreach(Auth::user()->contacts as $contact)

                            <hr class="border-0 h-1 bg-blue-600 my-2">
                            <h3>Details</h3>
                            <p>
                                {{ auth()->user()->service->details }}
                            </p>
                        @endforeach
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
@endsection
