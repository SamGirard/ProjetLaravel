@extends('layouts.app')
@section('title', "Liste des fournisseurs")
@section('contenu')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/f25f0490b7.js" crossorigin="anonymous"></script>

@if($fournisseur)
<form method="POST" action="{{route('updateFiche', [$fournisseur->id]) }}">
<div class="container mx-auto mt-6 flex">
        <div class="flex-1 p-6 ml-6">
            <div class="flex justify-evenly">
                <div class="mx-1">
                @php
    $statuses = ['Accepter', 'Refusé', 'En attente', 'Réviser'];
@endphp

<fieldset class="border-2 border-blue-600 rounded-lg p-4">
    <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Statut de la demande</legend>
    <p class="text-gray-800">
        @if(in_array($fournisseur->etatDemande, $statuses))
            <button id="dropdownEtatButton" data-dropdown-toggle="dropdownEtat" 
                    class="text-center inline-flex items-center 
                    {{ $fournisseur->etatDemande == 'En attente' ? 'bg-blue-100 text-blue-800' : ($fournisseur->etatDemande == 'Accepter' ? 'bg-green-100 text-green-800' : ($fournisseur->etatDemande == 'Réviser' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}
                    text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300" 
                    type="button" value="{{$fournisseur->etatDemande}}"> 
                {{ $fournisseur->etatDemande }} 
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <div id="dropdownEtat" class="hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class="p-2" aria-labelledby="dropdownEtatButton">
                    @foreach($statuses as $status)
                        @if($status !== $fournisseur->etatDemande)
                            <li>
                                <span class="changeStatusButton {{ $status == 'Accepter' ? 'bg-green-100 text-green-800' : ($status == 'En attente' ? 'bg-blue-100 text-blue-800' : ($status == 'Refusé' ? 'refusedButton bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }} 
                                             text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 hover:cursor-pointer">
                                    {{ $status }}
                                </span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div id="inputRefusedText" class="{{$fournisseur->etatDemande !== 'Refusé' ? 'hidden' : ''}}">
                <label for="message" class="text-sm font-medium text-gray-900 dark:text-white mr-2">Raison du refus</label>
                <textarea id="message" rows="4" class="p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Raison du refus...">{{ $fournisseur->raisonRefus }}</textarea>
            
                <div id="refusedCheckboxDiv" class="hidden">
                    <input id="refusedCheckbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="refusedCheckbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ajouter au courriel de refus</label>
                </div>
            </div>
        @endif
    </p>
</fieldset>

<script>
    $('#dropdownEtat').on('click', '.changeStatusButton', function () {
        $('#dropdownEtat').addClass('hidden');

        const newStatus = $(this).text().trim();
        const statusClasses = {
            'En attente': 'bg-blue-100 text-blue-800',
            'Accepter': 'bg-green-100 text-green-800',
            'Réviser': 'bg-yellow-100 text-yellow-800',
            'Refusé': 'refusedButton bg-red-100 text-red-800'
        };

        $('#dropdownEtatButton').html(`
            ${newStatus}
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        `).removeClass().addClass(`text-center inline-flex items-center text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 ${statusClasses[newStatus]}`).attr('value', newStatus);

        if ($(this).hasClass('refusedButton')) {
            $('#inputRefusedText').removeClass('hidden');
            $('#refusedCheckboxDiv').removeClass('hidden');
        } else {
            $('#inputRefusedText').addClass('hidden');
            $('#refusedCheckboxDiv').addClass('hidden');
        }

        const statuses = ['Accepter', 'En attente', 'Refusé', 'Réviser'];
        const updatedStatuses = statuses.filter(status => status !== newStatus);
        let dropdownContent = '';

        updatedStatuses.forEach(status => {
            dropdownContent += `
                <li>
                    <span class="changeStatusButton ${statusClasses[status]} 
                            text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 hover:cursor-pointer">
                        ${status}
                    </span>
                </li>
            `;
        });

        $('#dropdownEtat ul').html(dropdownContent);
    });
</script>


                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Identification</legend>
                        <p class="text-gray-800">{{ $fournisseur->neq }}</p>
                        <p class="text-gray-800">{{ $fournisseur->nomEntreprise }}</p>
                        <p class="text-gray-800">{{ $fournisseur->email }}</p>
                    </fieldset>

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Contacts</legend>
                        <div class="text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-900"><i
                                    class="text-xl fa-regular fa-pen-to-square"></i></a>
                        </div>
                        @foreach($contacts as $contact)
                            <div class="flex justify-between">
                                <div>
                                    <i class="fa-solid fa-address-book text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800">{{ $contact->prenom }} {{ $contact->nom }}</p>
                                    <p class="text-gray-800">{{ $contact->fonction }}</p>
                                    <p class="text-gray-800">{{ $contact->courriel }}</p>
                                    <p class="text-gray-800">{{ $contact->numTelephone }}</p>
                                </div>
                            </div>
                            <hr class="border-0 h-1 bg-blue-600 my-2">
                        @endforeach
                    </fieldset>

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Adresse</legend>
                        <div class="text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-900"><i
                                    class="text-xl fa-regular fa-pen-to-square"></i></a>
                        </div>
                        <p class="text-gray-800 my-1">{{ $fournisseur->numCivique }}
                            , {{ $fournisseur->rue }}</p>
                        <p class="text-gray-800 my-1">{{trim( $fournisseur->ville,'"') }}
                            ({{ $fournisseur->province }}) {{ $fournisseur->codePostal }}</p>
                        <p class="text-gray-800 my-1"><a target="_blank"
                                                         href="{{ $fournisseur->siteInternet }}">{{ $fournisseur->siteInternet }}</a>
                        </p>
                        @php
                            $telephoneNumbers = json_decode($fournisseur->numeroTelephone, true);
                        @endphp
                        @for($i=0;$i<count($telephoneNumbers);$i++)
                            <p class="text-gray-800 my1">
                                @if($fournisseur->typeNumTelephone[$i]=="Telecopieur")
                                    <i class="fa-solid fa-fax mr-2"></i>
                                @elseif($fournisseur->typeNumTelephone[$i]=="Cellulaire")
                                    <i class="fa-solid fa-phone mr-2"></i>
                                @else
                                    <i class="fa-solid fa-desktop mr-2"></i>
                                @endif
                                {{ $fournisseur->numeroTelephone[$i] }} #{{ $fournisseur->poste[$i] }}</p>
                        @endfor
                    </fieldset>
                </div>

                <div class="mx-1">

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Produits et services offerts
                        </legend>
                        <div class="text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-900"><i
                                    class="text-xl fa-regular fa-pen-to-square"></i></a>
                        </div>
                        @foreach($services as $service)
                            @php
                                $valeurs = explode('/', $service);
                            @endphp

                            <ul>
                                <li class="">{{ $valeurs[0] ?? '' }}
                                    @if(isset($valeurs[1]))
                                        <ul>
                                            <li class="ml-3">{{ $valeurs[1] }}
                                                @if(isset($valeurs[2]))
                                                    <ul>
                                                        <li class="ml-3">{{ $valeurs[2] }}
                                                            - {{ $valeurs[3] ?? '' }}</li>
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
                            
                        </p>
                    </fieldset>

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Brochures et cartes
                            d'affaire
                        </legend>
                        <p class="text-gray-800">
                        <ul>
                            @foreach($brochures as $brochure)
                                <li class="flex items-center mb-2">
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
                                        {{ $brochure->nom }}
                                    </a>
                                    <span class="ml-2">{{ number_format(Storage::size('public/brochures/' . $brochure->nom) / 1024, 2) }} Ko</span>
                                </li>
                            @endforeach

                        </ul>
                        </p>
                    </fieldset>

                </div>

            </div>
        </div>
    </div>
@endif
<div class="flex">
        @csrf
        @method('PATCH')

        @if($fournisseur)
            <select name="etatDemande">
                <option value="">État de la demande</option>
                <option value="Accepter">Accepter</option>
                <option value="Refusé">Refusé</option>
                <option value="En attente">En attente</option>
                <option value="À réviser">À réviser</option>
            </select>
        @endif
        <br>
        <button type="submit" class="mt-5">Enregistrer</button>
    </form>

    <div class="ml-4">
        @if($fournisseur)
            <p>État en cours : {{$fournisseur->etatDemande}}</p>
        @endif
    </div>
</div>

@endsection