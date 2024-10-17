@extends('app')

@section('content')
    @include('partials/header')

    <div class="container mx-auto mt-6 flex">
        <!-- Sidebar -->
        @include('partials/aside')

        <!-- Contenu principal -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6 ml-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">Ma fiche fournisseur</h1>
            <div class="flex justify-between">
                <div>
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Statut de la demande</legend>
                        <p class="text-gray-800">En attente</p>
                    </fieldset>
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Identification</legend>
                        <p class="text-gray-800">{{ Auth::user()->neq }}</p>
                        <p class="text-gray-800">{{ Auth::user()->nomEntreprise }}</p>
                        <p class="text-gray-800">{{ Auth::user()->email }}</p>
                    </fieldset>
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Contacts</legend>
                        @foreach(Auth::user()->contacts as $contact)
                            <div class="flex justify-between">
                                <div>
                                    <i class="fa-solid fa-address-book text-3xl"></i>
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

                <div>
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Adresse</legend>
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
                </div>

                <div>ssss</div>
            </div>
        </div>
    </div>
@endsection
