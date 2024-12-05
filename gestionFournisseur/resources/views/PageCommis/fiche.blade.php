@extends('layouts.app')
@section('title', "Liste des fournisseurs")
@section('contenu')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/f25f0490b7.js" crossorigin="anonymous"></script>

<form method="POST" id="formFournisseur" action="{{route('updateFiche', [$fournisseur]) }}">
@csrf
@method('PATCH')
    <div class="container mx-auto mt-6 flex">
        <div class="flex-1">
            <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">Fiche fournisseur - {{ $fournisseur->nomEntreprise }}</h1>
            <div class="flex justify-evenly">
                <div class="mx-1">
                    @php
                        $statuses = ['Acceptée', 'Refusée', 'En attente', 'À réviser'];
                    @endphp
                    @if($fournisseur)
                    <div class="container mx-auto mt-6 flex">
                            <div class="flex-1 p-6 ml-6">
                                <div class="flex justify-evenly">
                                    <div class="mx-1 w-96">
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Statut de la demande</legend>
                        @if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
                        <p class="text-gray-800">
                            @if(in_array($fournisseur->etatDemande, $statuses))
                                    <input type="hidden" name="etatDemande" id="etatDemande"
                                        value="{{ $fournisseur->etatDemande }}">
                                    <button id="dropdownEtatButton"
                                        class="text-center inline-flex items-center 
                                                {{ $fournisseur->etatDemande == 'En attente' ? 'bg-blue-100 text-blue-800' : ($fournisseur->etatDemande == 'Acceptée' ? 'bg-green-100 text-green-800' : ($fournisseur->etatDemande == 'À réviser' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}
                                                text-sm font-medium me-2 px-4 py-1.5 rounded dark:bg-green-900 dark:text-green-300" type="button">
                                        {{ $fournisseur->etatDemande }}
                                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                <div id="dropdownEtat" class="hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44"> 
                                    <ul class="p-2">
                                        @foreach($statuses as $status)
                                            @if($status !== $fournisseur->etatDemande)
                                                <li>
                                                    <span
                                                        class="changeStatusButton {{ $status == 'Acceptée' ? 'bg-green-100 text-green-800' : ($status == 'En attente' ? 'bg-blue-100 text-blue-800' : ($status == 'Refusée' ? 'refusedButton bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }} 
                                                                                                 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 hover:cursor-pointer">
                                                        {{ $status }}
                                                    </span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div id="inputRefusedText" class="{{$fournisseur->etatDemande !== 'Refusé' ? 'hidden' : ''}}">
                                    <label for="message" class="text-sm font-medium text-gray-900 dark:text-white mr-2">Raison
                                        du refus</label>
                                    <textarea id="message" rows="4"
                                        class="p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Raison du refus..." name="raisonRefus">{{ $fournisseur->raisonRefus }}</textarea>

                                    <div id="refusedCheckboxDiv" class="hidden">
                                        <input id="refusedCheckbox" type="checkbox" value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="refusedCheckbox"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ajouter au
                                            courriel de refus</label>
                                    </div>
                                </div>
                            @endif
                        </p>
                        @else

                            <span class="{{ $fournisseur->etatDemande == 'Acceptée' ? 'bg-green-100 text-green-800' : ($status == 'En attente' ? 'bg-blue-100 text-blue-800' : ($status == 'Refusée' ? 'refusedButton bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }} text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    {{ $fournisseur->etatDemande }}
                            </span>

                        @endif
                    </fieldset>

                    <script>
                        $('#dropdownEtatButton').on('click', function (event) {
                            if ($('#dropdownEtat').hasClass('hidden')) {
                                $('#dropdownEtat').removeClass('hidden');
                                setTimeout(() => {
                                    $(document).one('click', function (event) {
                                        if (!$(event.target).closest('#dropdownEtat, #dropdownEtatButton').length) {
                                            $('#dropdownEtat').addClass('hidden');
                                        }
                                    });
                                }, 0);
                            } else {
                                $('#dropdownEtat').addClass('hidden');
                            }
                        });

                        $('#dropdownEtat').on('click', '.changeStatusButton', function () {
                            $('#dropdownEtat').addClass('hidden');

                            const newStatus = $(this).text().trim();
                            const statusClasses = {
                                'En attente': 'bg-blue-100 text-blue-800',
                                'Acceptée': 'bg-green-100 text-green-800',
                                'À réviser': 'bg-yellow-100 text-yellow-800',
                                'Refusée': 'refusedButton bg-red-100 text-red-800'
                            };

                            $('#dropdownEtatButton').html(`
                                ${newStatus}
                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            `).removeClass().addClass(`text-center inline-flex items-center text-md font-medium me-2 px-4 py-1.5 rounded dark:bg-green-900 dark:text-green-300 ${statusClasses[newStatus]}`);

                            $('#etatDemande').attr('value', newStatus);

                            if ($(this).hasClass('refusedButton')) {
                                $('#inputRefusedText').removeClass('hidden');
                                $('#refusedCheckboxDiv').removeClass('hidden');
                            } else {
                                $('#inputRefusedText').addClass('hidden');
                                $('#refusedCheckboxDiv').addClass('hidden');
                            }

                            const statuses = ['Acceptée', 'En attente', 'Refusée', 'À réviser'];
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
                    <div class="text-right">
                    @if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
                        <button data-modal-target="identification-modal" data-modal-toggle="identification-modal" class="text-blue-600 hover:text-blue-900" type="button">
                            <i class="text-xl fa-regular fa-pen-to-square"></i>
                        </button>
                    @endif
                    </div>
                    <p id="neq-display" class="text-gray-800">{{ $fournisseur->neq }}</p>
                    <p id="nomEntreprise-display" class="text-gray-800">{{ $fournisseur->nomEntreprise }}</p>
                    <p id="email-display" class="text-gray-800">{{ $fournisseur->email }}</p>
                </fieldset>
                @if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
                <div id="identification-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Identification
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="identification-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="p-4 md:p-5 space-y-4">
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label for="neq" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NEQ</label>
                                        <input type="text" id="neq" name="neq" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->neq }}" value="{{ $fournisseur->neq }}" />
                                        <p id="neqErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un neq valide.</p>
                                    </div>
                                    <div>
                                        <label for="nomEntreprise" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de l'entreprise</label>
                                        <input type="text" name="nomEntreprise" id="nomEntreprise" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->nomEntreprise }}" value="{{ $fournisseur->nomEntreprise }}"  />
                                        <p id="nomErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un nom.</p>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse courriel</label>
                                    <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->email }}" value="{{ $fournisseur->email }}"  />
                                    <p id="emailErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Le courriel est invalide.</p>
                                </div> 
                            </div>
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="identification-modal" id="save-identification" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Continuer les modifications</button>
                                <button data-modal-hide="identification-modal" id="cancel-identification" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    var isNeqValid = true;
                    var isNameValid = true;
                    var isEmailValide = true;

                    function checkFormValidity() {
                        const saveButton = document.getElementById('save-identification');
                        if (isFormValid()) {
                            saveButton.removeAttribute('disabled');
                        } else {
                            saveButton.setAttribute('disabled', true);
                        }
                    }

                    document.getElementById('neq').addEventListener('input', function() {
                        const regexNeq = /^(11|22|33|88)[4-9]\d{6}$|^$/;
                        if (regexNeq.test(this.value)) {
                            $('#neqErrorMessage').addClass('hidden');
                            isNeqValid = true;
                        } else {
                            $('#neqErrorMessage').removeClass('hidden');
                            isNeqValid = false;
                        }
                        checkFormValidity();
                    });

                    document.getElementById('nomEntreprise').addEventListener('input', function() {
                        if (this.value !== "") {
                            $('#nomErrorMessage').addClass('hidden');
                            isNameValid = true;
                        } else {
                            $('#nomErrorMessage').removeClass('hidden');
                            isNameValid = false;
                        }
                        checkFormValidity();
                    });

                    document.getElementById('email').addEventListener('input', function() {
                        const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                        if (regexEmail.test(this.value)) {
                            $('#emailErrorMessage').addClass('hidden');
                            isEmailValide = true;
                        } else {
                            $('#emailErrorMessage').removeClass('hidden');
                            isEmailValide = false;
                        }
                        checkFormValidity();
                    });

                    const modal = document.getElementById('identification-modal');
                    const neqDisplay = document.getElementById('neq-display');
                    const nomEntrepriseDisplay = document.getElementById('nomEntreprise-display');
                    const emailDisplay = document.getElementById('email-display');

                    document.getElementById('save-identification').addEventListener('click', function(event) {
                        if (isFormValid()) {
                            neqDisplay.textContent = document.getElementById('neq').value;
                            nomEntrepriseDisplay.textContent = document.getElementById('nomEntreprise').value;
                            emailDisplay.textContent = document.getElementById('email').value;
                        }
                    });
                    
                    document.getElementById('cancel-identification').addEventListener('click', function(event) {
                        document.getElementById('neq').value = neqDisplay.textContent;
                        document.getElementById('nomEntreprise').value = nomEntrepriseDisplay.textContent;
                        document.getElementById('email').value = emailDisplay.textContent;
                    });

                    function isFormValid() {
                        return isEmailValide && isNeqValid && isNameValid;
                    }

                    checkFormValidity();
                </script>
                @endif
                    <fieldset id="contacts-fieldset" class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Contacts</legend>
                        <div class="text-right">
                        @if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
                        <button data-modal-target="contact-modal" data-modal-toggle="contact-modal" class="text-blue-600 hover:text-blue-900" type="button">
                            <i class="text-xl fa-regular fa-pen-to-square"></i>
                        </button>
                        @endif
                        </div>
                        @foreach($contacts as $contact)
                            <div class="flex justify-around">
                                <div class="flex items-center justify-center">
                                    <i class="fa-solid fa-address-book text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800">{{ $contact->nom }}, {{ $contact->prenom }}</p>
                                    <p class="text-gray-800">{{ $contact->fonction }}</p>
                                    <p class="text-gray-800">{{ $contact->courriel }}</p>
                                    <p class="text-gray-800">{{ preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $contact->numTelephone) }} #{{ $contact->poste }}</p>
                                </div>
                            </div>
                            <hr class="border-0 h-1 bg-blue-600 my-2">
                        @endforeach
                    </fieldset>

                    @if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
                    <div id="contact-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Contacts
                                    </h3>
                                    @if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="contact-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    @endif
                                </div>
                                <div class="p-4 md:p-5 space-y-4">
                                    <div id="accordion-contact" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
                                        <input type="hidden" name="contacts" id="contactsInput">
                                        @foreach($contacts as $contact)
                                            <h2 id="accordion-contact-heading-{{ $contact->id }}">
                                                <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-contact-body-{{ $contact->id }}" aria-expanded="false" aria-controls="accordion-contact-body-{{ $contact->id }}">
                                                <span>{{ $contact->nom }}, {{ $contact->prenom }}</span>
                                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                                </svg>
                                                </button>
                                            </h2>
                <!--CONTACT-->               <div id="accordion-contact-body-{{ $contact->id }}" class="hidden" aria-labelledby="accordion-contact-heading-1">
                                                <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                                    <div class="contact-accordion-grid grid gap-6 mb-6 md:grid-cols-2">
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                                            <input type="text" id="nom-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->nom }}" value="{{ $contact->nom }}"  />
                                                            <p id="nom-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un nom valide</p>
                                                        </div>
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                                            <input type="text" id="prenom-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->prenom }}" value="{{ $contact->prenom }}"  />
                                                            <p id="prenom-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un prénom valide</p>
                                                        </div>
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fonction</label>
                                                            <input type="text" id="fonction-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->fonction }}" value="{{ $contact->fonction }}"  />
                                                            <p id="fonction-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une fonction valide</p>
                                                        </div>  
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de téléphone</label>
                                                            <input type="text" id="numTelephone-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->numTelephone }}" value="{{ $contact->numTelephone }}"  />
                                                            <p id="numTelephone-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un numéro de téléphone valide</p>
                                                        </div>
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type de numéro</label>
                                                            <select id="typeNumTelephone-contact-{{ $contact->id }}" name="typeNumTelephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                <option value="Bureau" <?= $contact->typeNumTelephone == 'Bureau' ? 'selected' : '' ?>>Bureau</option>
                                                                <option value="Télécopieur" <?= $contact->typeNumTelephone == 'Télécopieur' ? 'selected' : '' ?>>Télécopieur</option>
                                                                <option value="Cellulaire" <?= $contact->typeNumTelephone == 'Cellulaire' ? 'selected' : '' ?>>Cellulaire</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Poste</label>
                                                            <input type="text" id="poste-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->poste }}" value="{{ $contact->poste }}"   />
                                                            <p id="poste-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un poste valide</p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-6">
                                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="courriel-contact-{{ $contact->id }}">Courriel</label>
                                                        <input type="text" name="courriel-contact-{{ $contact->id }}" id="courriel-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->courriel }}" value="{{ $contact->courriel }}"  />
                                                        <p id="courriel-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un courriel valide</p>
                                                    </div> 
                                                    <button id="delete-contact-{{ $contact->id }}" type="button" class="delete-contact-btn text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" data-contact-id="{{ $contact->id }}">
                                                        Supprimer
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
             <!--FIN CONTACT-->      </div>
                                    <button id="add-contact" type="button">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12h4m-2 2v-4M4 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        </svg>
                                    </button>
                                </div>
                                
                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="contact-modal" id="save-contact" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Continuer les modifications</button>
                                    <button data-modal-hide="contact-modal" id="cancel-contact" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        var contacts = @json($contacts);
                        var oldContacts = @json($contacts);
                        var fournisseur = @json($fournisseur);
                        document.querySelectorAll('.delete-contact-btn').forEach(button => {
                            button.addEventListener('click', async function (event) {
                                const contactId = event.target.getAttribute('data-contact-id');
                                const accordionElement = document.getElementById(`accordion-contact-body-${contactId}`);
                                const accordionHeading = document.getElementById(`accordion-contact-heading-${contactId}`);
                                
                                accordionElement.remove();
                                accordionHeading.remove();
                                contacts = contacts.filter(contact => contact.id !== Number(contactId));
                            });
                        });

                        for(let i=0; i < contacts.length;i++) {
                            var contact = contacts[i];
                            addValidationInput(contact.id);
                        }

                        document.getElementById('add-contact').addEventListener('click', function (event) {
                            const newContact = {
                                id: contacts.length > 0 ? contacts[contacts.length - 1].id + 1 : 1,
                                nom: "",
                                prenom: "",
                                courriel: "",
                                fonction: "",
                                typeNumTelephone: "",
                                numTelephone: 0,
                                poste: "",
                                fournisseur_id: fournisseur.id,
                            };

                            contacts.push(newContact);

                            const contact = contacts[contacts.length - 1];

                            const newAccordion = `
                                <h2 id="accordion-contact-heading-${contact.id}">
                                    <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-contact-body-${contact.id}" aria-expanded="true" aria-controls="accordion-contact-body-${contact.id}">
                                        <span>Nouveau contact</span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-contact-body-${contact.id}" class="hidden" aria-labelledby="accordion-contact-heading-${contact.id}">
                                    <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                        <div class="contact-accordion-grid grid gap-6 mb-6 md:grid-cols-2">
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                                <input type="text" id="nom-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un nom..."  />
                                                <p id="nom-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un nom valide</p>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                                <input type="text" id="prenom-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un prénom..."  />
                                                <p id="prenom-contact-error-${contact.id }" class="contact-error mt-2 hidden text-sm text-red-600 dark:text-red-500">Veuillez entrer un prénom valide</p>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fonction</label>
                                                <input type="text" id="fonction-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer une fonction..."  />
                                                <p id="fonction-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une fonction valide</p>
                                            </div>  
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de téléphone</label>
                                                <input type="text" id="numTelephone-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un numéro de téléphone..."  />
                                                <p id="numTelephone-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un numéro de téléphone valide</p>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type de numéro</label>
                                                <select id="typeNumTelephone-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="Bureau" selected}>Bureau</option>
                                                    <option value="Télécopieur">Télécopieur</option>
                                                    <option value="Cellulaire">Cellulaire</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Poste</label>
                                                <input type="text" id="poste-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer le poste du numéro..."  />
                                                <p id="poste-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un poste valide</p>
                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Courriel</label>
                                            <input type="email" id="courriel-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un courriel..."  />
                                            <p id="courriel-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un courriel valide</p>
                                        </div> 
                                        <button id="delete-contact-${contact.id}" type="button" class="delete-contact-btn text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" data-contact-id="${contact.id}">
                                            Supprimer
                                        </button>
                                    </div>
                                </div>`;

                            $('#accordion-contact').append(newAccordion);

                            document.getElementById('accordion-contact-heading-' + contact.id).addEventListener('click', function() {
                                const button = this.querySelector('button');
                                const body = document.getElementById(button.getAttribute('aria-controls'));
                                const isExpanded = button.getAttribute('aria-expanded') === 'true';

                                body.classList.toggle('hidden', !isExpanded);
                                
                                button.setAttribute('aria-expanded', !isExpanded);

                                const icon = button.querySelector('svg');
                                icon.classList.toggle('rotate-180', !isExpanded);
                            });

                            document.getElementById('delete-contact-' + contact.id).addEventListener('click', async function (event) {
                                const contactId = contact.id;
                                const accordionElement = document.getElementById(`accordion-contact-body-${contactId}`);
                                const accordionHeading = document.getElementById(`accordion-contact-heading-${contactId}`);
                                
                                accordionElement.remove();
                                accordionHeading.remove();
                                contacts = contacts.filter(contact => contact.id !== Number(contactId));
                            });

                            addValidationInput(contact.id);

                            isContactFormValid();
                        });

                        document.getElementById('cancel-contact').addEventListener('click', function (event) {
                            contacts = [...oldContacts];
                            const accordionContainer = document.getElementById('accordion-contact');
                            accordionContainer.innerHTML = '';

                            contacts.forEach(contact => {
                                const newAccordion = `
                                <h2 id="accordion-contact-heading-${contact.id}">
                                    <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-contact-body-${contact.id}" aria-expanded="true" aria-controls="accordion-contact-body-${contact.id}">
                                        <span>${contact.nom}, ${contact.prenom}</span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-contact-body-${contact.id}" class="hidden" aria-labelledby="accordion-contact-heading-${contact.id}">
                                    <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                        <div class="contact-accordion-grid grid gap-6 mb-6 md:grid-cols-2">
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                                <input type="text" id="nom-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un nom..."  value="${contact.nom}" />
                                                <p id="nom-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un nom valide</p>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                                <input type="text" id="prenom-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un prénom..."   value="${contact.prenom}" />
                                                <p id="prenom-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un prénom valide</p>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fonction</label>
                                                <input type="text" id="fonction-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer une fonction..."  value="${contact.fonction}"  />
                                                <p id="fonction-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une fonction valide</p>
                                            </div>  
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de téléphone</label>
                                                <input type="text" id="numTelephone-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un numéro de téléphone..."   value="${contact.numTelephone}" />
                                                <p id="numTelephone-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un numéro de téléphone valide</p>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type de numéro</label>
                                                <select id="typeNumTelephone-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="Bureau" ${contact.typeNumTelephone == 'Bureau' ? 'selected' : ''}>Bureau</option>
                                                    <option value="Télécopieur" ${contact.typeNumTelephone == 'Télécopieur' ? 'selected' : ''}>Télécopieur</option>
                                                    <option value="Cellulaire" ${contact.typeNumTelephone == 'Cellulaire' ? 'selected' : ''}>Cellulaire</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Poste</label>
                                                <input type="text" id="poste-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer le poste du numéro..."   value="${contact.poste}" />
                                                <p id="poste-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un poste valide</p>
                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Courriel</label>
                                            <input type="email" id="courriel-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un courriel..."   value="${contact.courriel}"/>
                                            <p id="courriel-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un courriel valide</p>
                                        </div> 
                                        <button id="delete-contact-${contact.id}" type="button" class="delete-contact-btn text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" data-contact-id="${contact.id}">
                                            Supprimer
                                        </button>
                                    </div>
                                </div>`;

                                accordionContainer.insertAdjacentHTML('beforeend', newAccordion);

                                document.getElementById(`delete-contact-${contact.id}`).addEventListener('click', async function (event) {
                                    const contactId = contact.id;
                                    const accordionElement = document.getElementById(`accordion-contact-body-${contactId}`);
                                    const accordionHeading = document.getElementById(`accordion-contact-heading-${contactId}`);
                                    
                                    accordionElement.remove();
                                    accordionHeading.remove();
                                    contacts = contacts.filter(contact => contact.id !== contactId);
                                });

                                document.getElementById(`accordion-contact-heading-${contact.id}`).addEventListener('click', function() {
                                    const button = this.querySelector('button');
                                    const body = document.getElementById(button.getAttribute('aria-controls'));
                                    const isExpanded = button.getAttribute('aria-expanded') === 'true';

                                    body.classList.toggle('hidden', !isExpanded);
                                    
                                    button.setAttribute('aria-expanded', !isExpanded);

                                    const icon = button.querySelector('svg');
                                    icon.classList.toggle('rotate-180', !isExpanded);
                                });

                                addValidationInput(contact.id);
                            });
                        });

                        function addValidationInput(contactId) {
                            document.getElementById(`nom-contact-${contactId}`).addEventListener('input', function (event) {
                                const nameRegex = /^[A-Za-z' -]{1,32}$/;
                                if (!nameRegex.test(this.value) || this.value.length <= 0) {
                                    $('#nom-contact-error-'+contactId).removeClass('hidden');
                                }
                                else {
                                    $('#nom-contact-error-'+contactId).addClass('hidden');
                                    contacts.find(c => c.id === contactId).nom = this.value;

                                    const accordionHeader = document.querySelector(`#accordion-contact-heading-${contactId} span`);
                                    if (accordionHeader) {
                                        const prenom = contacts.find(c => c.id === contactId).prenom;
                                        accordionHeader.innerText = `${this.value}, ${prenom}`;
                                    }
                                }

                                isContactFormValid();
                            });

                            document.getElementById(`prenom-contact-${contactId}`).addEventListener('input', function (event) {
                                const nameRegex = /^[A-Za-z' -]{1,32}$/;
                                if (!nameRegex.test(this.value) || this.value.length <= 0) {
                                    $('#prenom-contact-error-'+contactId).removeClass('hidden');
                                }
                                else {
                                    $('#prenom-contact-error-'+contactId).addClass('hidden');
                                    contacts.find(c => c.id === contactId).prenom = this.value;

                                    const accordionHeader = document.querySelector(`#accordion-contact-heading-${contactId} span`);
                                    if (accordionHeader) {
                                        const nom = contacts.find(c => c.id === contactId).nom;
                                        accordionHeader.innerText = `${nom}, ${this.value}`;
                                    }
                                }

                                isContactFormValid();
                            });

                            document.getElementById(`fonction-contact-${contactId}`).addEventListener('input', function (event) {
                                if (this.value.length > 32 || this.value.length <= 0) {
                                    $('#fonction-contact-error-'+contactId).removeClass('hidden');
                                }
                                else {
                                    $('#fonction-contact-error-'+contactId).addClass('hidden');
                                    contacts.find(c => c.id === contactId).fonction = this.value;
                                }

                                isContactFormValid();
                            });

                            document.getElementById(`courriel-contact-${contactId}`).addEventListener('input', function (event) {
                                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                if (this.value.length > 64 || this.value.length <= 0 || !emailRegex.test(this.value)) {
                                    isValid = false;
                                    $('#courriel-contact-error-'+contactId).removeClass('hidden');
                                }
                                else {
                                    $('#courriel-contact-error-'+contactId).addClass('hidden');
                                    contacts.find(c => c.id === contactId).courriel = this.value;
                                }

                                isContactFormValid();
                            });

                            document.getElementById(`numTelephone-contact-${contactId}`).addEventListener('input', function (event) {
                                const phoneRegex = /^\d{10}$/;
                                if (!phoneRegex.test(this.value) || this.value.length <= 0) {
                                    isValid = false;
                                    $('#numTelephone-contact-error-'+contactId).removeClass('hidden');
                                }
                                else {
                                    $('#numTelephone-contact-error-'+contactId).addClass('hidden');
                                    contacts.find(c => c.id === contactId).numTelephone = this.value;
                                }

                                isContactFormValid();
                            });

                            document.getElementById(`poste-contact-${contactId}`).addEventListener('input', function (event) {
                                const posteRegex = /^\d{0,6}$/;
                                if (!posteRegex.test(this.value) || this.value.length <= 0) {
                                    isValid = false;
                                    $('#poste-contact-error-'+contactId).removeClass('hidden');
                                }
                                else {
                                    $('#poste-contact-error-'+contactId).addClass('hidden');
                                    contacts.find(c => c.id === contactId).poste = this.value;
                                }

                                isContactFormValid();
                            });

                            document.getElementById(`typeNumTelephone-contact-${contactId}`).addEventListener('change', function (event) {
                                contacts.find(c => c.id === contactId).typeNumTelephone = $('#typeNumTelephone-contact-' + contactId).val();

                                isContactFormValid();
                            });
                        }

                        function isContactFormValid() {
                            const isThereError = !Array.from(document.querySelectorAll('p.contact-error')).every(p => 
                                                    p.classList.contains('hidden')
                                                );
                            const saveButton = document.getElementById('save-contact');

                            function isContactFieldsValid(contacts) {
                                for (let contact of contacts) {
                                    const fields = [
                                        `nom-contact-${contact.id}`,
                                        `prenom-contact-${contact.id}`,
                                        `fonction-contact-${contact.id}`,
                                        `numTelephone-contact-${contact.id}`,
                                        `typeNumTelephone-contact-${contact.id}`,
                                        `poste-contact-${contact.id}`,
                                        `courriel-contact-${contact.id}`
                                    ];

                                    for (let field of fields) {
                                        const fieldValue = document.getElementById(field)?.value;
                                        if (!fieldValue) {
                                            return false;
                                        }
                                    }
                                }

                                return true;
                            } 

                            const isAllContactsValid = isContactFieldsValid(contacts);

                            if(isThereError || !isAllContactsValid) {
                                saveButton.setAttribute('disabled', true);
                            } else {
                                saveButton.removeAttribute('disabled');
                            }
                        };
                        
                        document.getElementById('save-contact').addEventListener('click', function (event) {
                                oldContacts = [...contacts];
                                const fieldset = document.getElementById("contacts-fieldset");

                                while (fieldset.children.length > 2) {
                                    fieldset.removeChild(fieldset.lastChild);
                                }

                                contacts.forEach(contact => {
                                    const contactDiv = document.createElement("div");
                                    contactDiv.className = "flex justify-around";

                                    const iconDiv = document.createElement("div");
                                    iconDiv.className = "flex items-center justify-center";
                                    iconDiv.innerHTML = `<i class="fa-solid fa-address-book text-2xl"></i>`;
                                    contactDiv.appendChild(iconDiv);

                                    const detailsDiv = document.createElement("div");
                                    detailsDiv.innerHTML = `
                                        <p class="text-gray-800">${contact.nom}, ${contact.prenom}</p>
                                        <p class="text-gray-800">${contact.fonction}</p>
                                        <p class="text-gray-800">${contact.courriel}</p>
                                        <p class="text-gray-800">${contact.numTelephone.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3')} #${contact.poste}</p>
                                    `;
                                    contactDiv.appendChild(detailsDiv);

                                    fieldset.appendChild(contactDiv);
                                    const hr = document.createElement("hr");
                                    hr.className = "border-0 h-1 bg-blue-600 my-2";
                                    fieldset.appendChild(hr);
                                });
                        });

                        document.getElementById('formFournisseur').addEventListener('submit', function (e) {
                            const contactsJson = JSON.stringify(contacts);
                            document.getElementById('contactsInput').value = contactsJson;
                        });

                    </script>
                    @endif

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Adresse</legend>
                        <div class="text-right">
                        @if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
                            <button data-modal-target="adresse-modal" data-modal-toggle="adresse-modal" class="text-blue-600 hover:text-blue-900" type="button">
                                <i class="text-xl fa-regular fa-pen-to-square"></i>
                            </button>
                        @endif
                        </div>
                        <p id="adresseDisplay"class="text-gray-800 my-1">{{ $fournisseur->numCivique }}
                            , {{ $fournisseur->rue }}</p>
                        <p id="coordoneDisplay" class="text-gray-800 my-1">{{trim($fournisseur->ville, '"') }}
                            ({{ $fournisseur->province }}) {{ $fournisseur->codePostal }}</p>
                        <a id="siteInternetDisplay" class="text-gray-800 my-1" href="{{ $fournisseur->siteInternet }}" target="_blank">
                                {{ $fournisseur->siteInternet }}
                        </a>
                        @php
                            $telephoneNumbers = json_decode($fournisseur->numeroTelephone, true);
                            if (!is_array($telephoneNumbers)) {
                                $telephoneNumbers = [$telephoneNumbers];
                            }
                            $typeNumTelephone = json_decode($fournisseur->typeNumTelephone, true);
                            $poste = json_decode($fournisseur->poste, true);
                        @endphp
                        <div class="telephoneDisplay">
                            @for($i = 0; $i < count($telephoneNumbers); $i++)
                                <p class="text-gray-800 my-1">
                                    @if(isset($typeNumTelephone[$i]) && $typeNumTelephone[$i] == "Telecopieur")
                                        <i class="fa-solid fa-fax mr-2"></i>
                                    @elseif(isset($typeNumTelephone[$i]) && $typeNumTelephone[$i] == "Cellulaire")
                                        <i class="fa-solid fa-phone mr-2"></i>
                                    @else
                                        <i class="fa-solid fa-desktop mr-2"></i>
                                    @endif
                                    {{ preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $telephoneNumbers[$i]) }} @isset($poste[$i]) #{{ $poste[$i] }} @endisset
                                </p>
                            @endfor
                        </div>
                    </fieldset>

                    <div id="adresse-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Adresse
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="adresse-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <div class="p-4 md:p-5 space-y-4">
                                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                                        <div>
                                            <label for="numCivique" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro civique</label>
                                            <input type="text" name="numCivique" id="numCivique" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->numCivique }}" value="{{ $fournisseur->numCivique }}" />
                                            <p id="numCiviqueErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un numéro civique valide.</p>
                                        </div>
                                        <div>
                                            <label for="rue" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rue</label>
                                            <input type="text" name="rue" id="rue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->rue }}" value="{{ $fournisseur->rue }}"  />
                                            <p id="rueErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une rue valide.</p>
                                        </div>
                                        <div>
                                            <label for="ville" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ville</label>
                                            <input type="text" name="ville" id="ville" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->ville }}" value="{{ $fournisseur->ville }}"  />
                                            <p id="villeErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une ville valide.</p>
                                        </div>
                                        <div>
                                            <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                                            <input type="text" name="province" id="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->province }}" value="{{ $fournisseur->province }}"  />
                                            <p id="provinceErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une province valide.</p>
                                        </div>
                                        <div>
                                            <label for="regionAdministrative" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Région Administrative</label>
                                            <input type="text" name="regionAdministrative" id="regionAdministrative" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->regionAdministrative }}" value="{{ $fournisseur->regionAdministrative }}" />
                                            <p id="regionAdministrativeErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez choisir une région administrative.</p>
                                        </div>
                                        <div>
                                            <label for="code_administratif" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Administratif</label>
                                            <input type="text" name="code_administratif" id="code_administratif" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->code_administratif }}" value="{{ $fournisseur->code_administratif }}"  />
                                            <p id="code_administratifErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un code administraif valide.</p>
                                        </div>
                                        <div>
                                            <label for="codePostal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code postal</label>
                                            <input type="text" name="codePostal" id="codePostal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->codePostal }}" value="{{ $fournisseur->codePostal }}"  />
                                            <p id="codePostalErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un code postal valide.</p>
                                        </div>
                                        <div>
                                            <label for="siteInternet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Site internet</label>
                                            <input type="url" name="siteInternet" id="siteInternet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->siteInternet }}" value="{{ $fournisseur->siteInternet }}" />
                                            <p id="siteInternetErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un site internet valide.</p>
                                        </div>
                                    </div>
                                    <input type="hidden" name="typeNumTelephoneTest" id="typeNumTelephoneTest"
                                        value="{{ $fournisseur->typeNumTelephone }}">
                                    <input type="hidden" name="numeroTelephoneTest" id="numeroTelephoneTest"
                                        value="{{ $fournisseur->numeroTelephone }}">
                                    <input type="hidden" name="posteTest" id="posteTest"
                                        value="{{ $fournisseur->poste }}">
                                    <div id="telephone-container">
                                        @for($i = 0; $i < count($telephoneNumbers); $i++)
                                        <div class="telephoneFormDisplay">
                                        </div>
                                        <div class="mb-6 telephoneFormDisplay">
                                            <div class="flex items-center">
                                                <div class="flex flex-col">
                                                    <label 
                                                        for="typeNumTelephone-contact-{{ $fournisseur->id }}-{{ $i }}" 
                                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
                                                    >
                                                        Type {{ $i+1 }}
                                                    </label> 
                                                    <select 
                                                        id="typeNumTelephone-contact-{{ $fournisseur->id }}-{{ $i }}"
                                                        class="typeNumTelephone bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    >
                                                        <option value="Bureau" {{ $typeNumTelephone[$i] == 'Bureau' ? 'selected' : '' }}>Bureau</option>
                                                        <option value="Télécopieur" {{ $typeNumTelephone[$i] == 'Télécopieur' ? 'selected' : '' }}>Télécopieur</option>
                                                        <option value="Cellulaire" {{ $typeNumTelephone[$i] == 'Cellulaire' ? 'selected' : '' }}>Cellulaire</option>
                                                    </select>
                                                </div>
                                                <div class="flex-grow">
                                                    <label 
                                                        for="numTelephone-contact-{{ $fournisseur->id }}-{{ $i }}" 
                                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
                                                    >
                                                        Numéro de téléphone {{ $i+1 }}
                                                    </label>
                                                    <input 
                                                        type="text" 
                                                        id="numTelephone-contact-{{ $fournisseur->id }}-{{ $i }}" 
                                                        class="numTelephone bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                                        placeholder="{{ $telephoneNumbers[$i] }}" 
                                                        value="{{ $telephoneNumbers[$i] }}"
                                                         
                                                    />
                                                </div>

                                                <div class="flex flex-col w-1/4">
                                                    <label 
                                                        for="poste-contact-{{ $fournisseur->id }}-{{ $i }}" 
                                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white"
                                                    >
                                                        Poste {{ $i+1 }}
                                                    </label>
                                                    <input 
                                                        type="text" 
                                                        id="poste-contact-{{ $fournisseur->id }}-{{ $i }}" 
                                                        class="poste bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-r-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                                        placeholder="{{ $poste[$i] }}" 
                                                        value="{{ $poste[$i] }}"
                                                         
                                                    />
                                                </div>

                                                <button 
                                                    type="button" 
                                                    class="text-red-500 hover:text-red-700 ml-2 mt-6" 
                                                    id="delete-contact"
                                                >
                                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <p id="typeNumTelephone-contact-{{ $fournisseur->id }}-{{ $i }}-error" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">
                                                Type de numéro invalide. Choisissez Bureau, Télécopieur ou Cellulaire.
                                            </p>
                                            <p id="numTelephone-contact-{{ $fournisseur->id }}-{{ $i }}-error" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">
                                                Numéro de téléphone invalide. Format attendu: ###-###-####.
                                            </p>
                                            <p id="poste-contact-{{ $fournisseur->id }}-{{ $i }}-error" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">
                                                Poste invalide. Maximum 6 chiffres numériques uniquement.
                                            </p>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="adresse-modal" id="save-adresse" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Continuer les modifications</button>
                                    <button type="button" id="add-number" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 ml-2.5 py-2.5 text-center">Ajouter un numéro</button>
                                    <button data-modal-hide="adresse-modal" id="cancel-adresse" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    var isNumCiviqueValid = true;
                    var isRueValid = true;
                    var isVilleValid = true;
                    var isPronviceValid = true;
                    var isCodePostalValid = true;
                    var isSiteInternetValid = true;
                    var isRegionAdministrativeValid = true;
                    var isCodeAdministratifValid = true;

                    function validateType(selectElement) {
                        return true;
                  
                    }

                    function validateNumero(inputElement) {
                        return true;
                        const regex = /^\d{3}-\d{3}-\d{4}$|^\d{10}$/;
                        if (!regex.test(inputElement.value)) {
                            $('#' + inputElement.id + '-error').removeClass('hidden');
                            return false;
                        } else {
                            $('#' + inputElement.id + '-error').addClass('hidden');
                            return true;
                        }
                    }

                    function validatePoste(inputElement) {
                        const regex = /^\d{0,6}$/;
                        if (!regex.test(inputElement.value)) {
                            $('#' + inputElement.id + '-error').removeClass('hidden');
                            return false;
                        } else {
                            $('#' + inputElement.id + '-error').addClass('hidden');
                            return true;
                        }
                    }

                    function validateAllNum() {
                        let allValid = true;

                        document.querySelectorAll('.typeNumTelephone').forEach(select => {
                            allValid = true;
                            
                        
                        });

                        document.querySelectorAll('.numTelephone').forEach(input => {
                            if (!validateNumero(input)) {
                                allValid = false;
                            }
                        });

                        document.querySelectorAll('.poste').forEach(input => {
                            if (!validatePoste(input)) {
                                allValid = false;
                            }
                        });

                        return allValid;
                    }

                    function attachValidation() {
                        document.querySelectorAll('.typeNumTelephone').forEach(select => {
                            select.addEventListener('input', () => validateType(select));
                            select.addEventListener('input', () => checkAdressFormValidity());
                        });

                        document.querySelectorAll('.numTelephone').forEach(input => {
                            input.addEventListener('input', () => validateNumero(input));
                            input.addEventListener('input', () => checkAdressFormValidity());
                        });

                        document.querySelectorAll('.poste').forEach(input => {
                            input.addEventListener('input', () => validatePoste(input));
                            input.addEventListener('input', () => checkAdressFormValidity());
                        });
                    }

                    attachValidation();

                    function addDeleteFunctionality(button) {
                        button.addEventListener('click', function () {
                            const formGroup = button.closest('.telephoneFormDisplay');
                            formGroup.remove();
                        });
                    }

                    document.querySelectorAll('#delete-contact').forEach(addDeleteFunctionality);

                    document.getElementById('add-number').addEventListener('click', function () {
                        const container = document.querySelector('.telephoneFormDisplay') 
                            ? document.querySelector('.telephoneFormDisplay').parentElement 
                            : document.getElementById('telephone-container');
                        const formGroups = container.querySelectorAll('.telephoneFormDisplay');
                        const newIndex = formGroups.length;

                        const newFormGroup = document.createElement('div');
                        newFormGroup.classList.add('mb-6', 'telephoneFormDisplay');
                        newFormGroup.innerHTML = `
                            <div class="flex items-center">
                                <div class="flex flex-col">
                                    <label for="typeNumTelephone-contact-{{$fournisseur->id }}-${newIndex }" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                        Type ${newIndex}
                                    </label>
                                    <select 
                                        id="typeNumTelephone-contact-{{$fournisseur->id }}-${newIndex }"
                                        class="typeNumTelephone bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    >
                                        <option value="Bureau">Bureau</option>
                                        <option value="Télécopieur">Télécopieur</option>
                                        <option value="Cellulaire">Cellulaire</option>
                                    </select>
                                </div>

                                <div class="flex-grow">
                                    <label for="numTelephone-contact-{{ $fournisseur->id }}-${newIndex }" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                        Numéro de téléphone ${newIndex}
                                    </label>
                                    <input 
                                        type="text" 
                                        id="numTelephone-contact-{{ $fournisseur->id }}-${newIndex }" 
                                        class="numTelephone bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                        placeholder="Entrez le numéro" 
                                         
                                    />
                                </div>

                                <div class="flex flex-col w-1/4">
                                    <label for="poste-contact-{{ $fournisseur->id }}-${newIndex }" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                        Poste ${newIndex}
                                    </label>
                                    <input 
                                        type="text" 
                                        id="poste-contact-{{ $fournisseur->id }}-${newIndex }" 
                                        class="poste bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-r-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                        placeholder="Entrez le poste"  
                                         
                                    />
                                </div>

                                <button 
                                    type="button" 
                                    class="text-red-500 hover:text-red-700 ml-2 mt-6 delete-contact"
                                >
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                    </svg>
                                </button>
                            </div>
                            <p id="typeNumTelephone-contact-{{$fournisseur->id }}-${newIndex }-error" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">
                                            Type de numéro invalide. Choisissez Bureau, Télécopieur ou Cellulaire.
                                        </p>
                                        <p id="numTelephone-contact-{{ $fournisseur->id }}-${newIndex }-error" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">
                                            Numéro de téléphone invalide. Format attendu: ###-###-####.
                                        </p>
                                        <p id="poste-contact-{{ $fournisseur->id }}-${newIndex }-error" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">
                                            Poste invalide. Maximum 6 chiffres numériques uniquement.
                                        </p>
                        `;

                        container.appendChild(newFormGroup);

                        const deleteButton = newFormGroup.querySelector('.delete-contact');
                        addDeleteFunctionality(deleteButton);
                        checkAdressFormValidity();
                    });

                    document.getElementById('add-number').addEventListener('click', () => {
                        setTimeout(attachValidation, 0);
                    });

                    function checkAdressFormValidity() {
                        const saveButton = document.getElementById('save-adresse');
                        if (isAdressFormValid() && validateAllNum()) {
                            saveButton.removeAttribute('disabled');
                        } else {
                            saveButton.setAttribute('disabled', true);
                        }
                    }

                    document.getElementById('numCivique').addEventListener('input', function() {
                        const regexNeq = /^[a-zA-Z0-9]{1,8}$/;
                        if (regexNeq.test(this.value)) {
                            $('#numCiviqueErrorMessage').addClass('hidden');
                            isNumCiviqueValid = true;
                        } else {
                            $('#numCiviqueErrorMessage').removeClass('hidden');
                            isNumCiviqueValid = false;
                        }
                        checkAdressFormValidity();
                    });

                    document.getElementById('rue').addEventListener('input', function() {
                        const regexNeq = /^[\wÀ-ÖØ-öø-ÿ\-\',.\s]{1,64}$/;
                        if (regexNeq.test(this.value)) {
                            $('#rueErrorMessage').addClass('hidden');
                            isRueValid = true;
                        } else {
                            $('#rueErrorMessage').removeClass('hidden');
                            isRueValid = false;
                        }
                        checkAdressFormValidity();
                    });

                    document.getElementById('ville').addEventListener('input', function() {
                        const regexNeq = /^[\wÀ-ÖØ-öø-ÿ\-\',.\s]{1,64}$/;
                        if (regexNeq.test(this.value)) {
                            $('#villeErrorMessage').addClass('hidden');
                            isVilleValid = true;
                        } else {
                            $('#villeErrorMessage').removeClass('hidden');
                            isVilleValid = false;
                        }
                        checkAdressFormValidity();
                    });

                    document.getElementById('province').addEventListener('input', function() {
                        if (this.value != "") {
                            $('#villeErrorMessage').addClass('hidden');
                            isVilleValid = true;
                        } else {
                            $('#villeErrorMessage').removeClass('hidden');
                            isVilleValid = false;
                        }
                        checkAdressFormValidity();
                    });

                    document.getElementById('regionAdministrative').addEventListener('input', function() {
                        if (this.value != "") {
                            $('#regionAdministrativeErrorMessage').addClass('hidden');
                            isRegionAdministrativeValid = true;
                        } else {
                            $('#regionAdministrativeErrorMessage').removeClass('hidden');
                            isRegionAdministrativeValid = false;
                        }
                        checkAdressFormValidity();
                    });

                    document.getElementById('code_administratif').addEventListener('input', function() {
                        if (this.value != "") {
                            $('#code_administratifErrorMessage').addClass('hidden');
                            isCodeAdministratifValid = true;
                        } else {
                            $('#code_administratifErrorMessage').removeClass('hidden');
                            isCodeAdministratifValid = false;
                        }
                        checkAdressFormValidity();
                    });

                    document.getElementById('codePostal').addEventListener('input', function() {
                        const regexNeq = /^[A-Za-z0-9]{6}$/;
                        if (regexNeq.test(this.value)) {
                            $('#codePostalErrorMessage').addClass('hidden');
                            isCodePostalValid = true;
                        } else {
                            $('#codePostalErrorMessage').removeClass('hidden');
                            isCodePostalValid = false;
                        }
                        checkAdressFormValidity();
                    });

                    document.getElementById('siteInternet').addEventListener('input', function() {
                        const regexNeq = /^(https?:\/\/)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,6}(:\d+)?(\/[a-zA-Z0-9\-._~:/?#[\]@!$&'()*+,;=]*)?/;
                        if (regexNeq.test(this.value)) {
                            $('#siteInternetErrorMessage').addClass('hidden');
                            isSiteInternetValid = true;
                        } else {
                            $('#siteInternetErrorMessage').removeClass('hidden');
                            isSiteInternetValid = false;
                        }
                        checkAdressFormValidity();
                    });

                    document.getElementById('save-adresse').addEventListener('click', function(event) {
                        if (isAdressFormValid()) {
                            document.getElementById('adresseDisplay').textContent = 
                                document.getElementById('numCivique').value + " ," +
                                document.getElementById('rue').value; 
                            document.getElementById('coordoneDisplay').textContent = 
                                document.getElementById('ville').value.replace(/"/g, '') + " (" + 
                                document.getElementById('province').value + ") " + 
                                document.getElementById('codePostal').value;
                            document.getElementById('siteInternetDisplay').textContent = document.getElementById('siteInternet').value;
                            document.getElementById('siteInternetDisplay').href = document.getElementById('siteInternet').value;

                            var typeNumTelephoneValue = "[";
                            var numeroTelephoneValue = "[";
                            var posteValue = "[";

                            const container = document.getElementById('telephone-container');
                            const formGroups = container.querySelectorAll('.telephoneFormDisplay');

                            formGroups.forEach((formGroup, index) => {
                                const formTypeNumTelephone = document.getElementById('typeNumTelephone-contact-{{$fournisseur->id }}-'+index);
                                const formNumTelephone = document.getElementById(`numTelephone-contact-{{$fournisseur->id }}-${index}`);
                                const formPoste = document.getElementById(`poste-contact-{{$fournisseur->id }}-${index}`);

                                if (formTypeNumTelephone && formNumTelephone && formPoste) {
                                    typeNumTelephoneValue += '"' + formTypeNumTelephone.value + '",';
                                    numeroTelephoneValue += '' + formNumTelephone.value + ',';
                                    posteValue += '"' + formPoste.value + '",';
                                }
                            });

                            typeNumTelephoneValue = typeNumTelephoneValue.slice(0, -1);
                            numeroTelephoneValue = numeroTelephoneValue.slice(0, -1);
                            posteValue = posteValue.slice(0, -1);
                            typeNumTelephoneValue += "]";
                            numeroTelephoneValue += "]";
                            posteValue += "]";

                            document.getElementById('typeNumTelephoneTest').value = typeNumTelephoneValue;
                            document.getElementById('numeroTelephoneTest').value = numeroTelephoneValue;
                            document.getElementById('posteTest').value = posteValue.replace(/#/g, '');
                            const telephoneDisplay = document.querySelector('.telephoneDisplay');
                            telephoneDisplay.innerHTML = '';

                            const typeNumTelephoneArray = JSON.parse(typeNumTelephoneValue);
                            const numeroTelephoneArray = JSON.parse(numeroTelephoneValue);
                            const posteArray = JSON.parse(posteValue);
                            console.log(posteValue)
                            typeNumTelephoneArray.forEach((type, index) => {
                                let icon = '';
                                if (type === "Telecopieur") {
                                    icon = '<i class="fa-solid fa-fax mr-2"></i>';
                                } else if (type === "Cellulaire") {
                                    icon = '<i class="fa-solid fa-phone mr-2"></i>';
                                } else {
                                    icon = '<i class="fa-solid fa-desktop mr-2"></i>';
                                }

                                const telephoneText = numeroTelephoneArray[index] + (posteArray[index] ? ' #' + posteArray[index] : '');
                                telephoneDisplay.innerHTML += `<p class="text-gray-800 my-1">${icon} ${telephoneText}</p>`;
                            });
                        }
                    });
                    
                    document.getElementById('cancel-adresse').addEventListener('click', function(event) {
                        document.getElementById('numCivique').value = document.getElementById('adresseDisplay').textContent.split(',')[0];
                        document.getElementById('rue').value = document.getElementById('adresseDisplay').textContent.split(',')[1];
                        document.getElementById('ville').value = document.getElementById('coordoneDisplay').textContent.split(' (')[0];
                        document.getElementById('province').value = document.getElementById('coordoneDisplay').textContent.split(' (')[1].split(')')[0];
                        document.getElementById('codePostal').value = document.getElementById('coordoneDisplay').textContent.split(' (')[1].split(')')[1];
                        document.getElementById('siteInternet').value = document.getElementById('siteInternetDisplay').textContent;
                    });

                    function isAdressFormValid() {
                        return isNumCiviqueValid && isRueValid && isVilleValid && isPronviceValid && isCodePostalValid && isSiteInternetValid;
                    }

                    checkAdressFormValidity();
                </script>

                <div class="mx-1">
                    <fieldset class="border-2 border-blue-600 rounded-lg p-4">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Produits et services offerts
                        </legend>
                        <div class="text-right">
                        @if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
                            <button data-modal-target="produits-modal" data-modal-toggle="produits-modal" class="text-blue-600 hover:text-blue-900" type="button">
                                <i class="text-xl fa-regular fa-pen-to-square"></i>
                            </button>
                        @endif
                        </div>

                        @php
                            $categories = [];

                            // Loop through each service in the collection
                            foreach ($services as $service) {
                                // Decode the JSON string in 'produit_services' to an array
                                $produitServices = json_decode($service->produit_services, true);

                                // Loop through each product service in 'produit_services'
                                foreach ($produitServices as $produit) {
                                    $valeurs = explode('/', $produit);

                                    // Structurer les catégories et sous-catégories sans répétition
                                    $categorie = $valeurs[0] ?? '';
                                    $sousCategorie = $valeurs[1] ?? '';
                                    $element = $valeurs[2] ?? '';
                                    $sousElement = $valeurs[3] ?? '';

                                    // Organize by categories and subcategories
                                    if (!isset($categories[$categorie])) {
                                        $categories[$categorie] = [];
                                    }
                                    if (!isset($categories[$categorie][$sousCategorie])) {
                                        $categories[$categorie][$sousCategorie] = [];
                                    }
                                    $categories[$categorie][$sousCategorie][] = [$element, $sousElement];
                                }
                            }
                        @endphp

                        <div id="produitsListFieldset">
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
                        </div>
                        <hr class="border-0 h-1 bg-blue-600 my-2">
                        <h2><strong>Détails</strong></h2>
                        <p id="detailsFieldset">
                            {{$service->details}}
                        </p>
                    </fieldset>

                    <div id="produits-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Produits et services offerts
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="produits-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <input type="hidden" name="produit_services" id="produit_services"
                                        value="{{ $service->produit_services }}">
                                <div class="p-4 md:p-5 space-y-4">
                                    <h4 class="font-semibold text-gray-700">Liste des produits et services</h4>
                                    <ul id="product-list-modal" class="space-y-3">
                                        @foreach($categories as $categorie => $sousCategories)
                                            <li data-category="{{ $categorie }}">
                                                <strong>{{ $categorie }}</strong>
                                                <ul class="ml-4 space-y-2">
                                                    @foreach($sousCategories as $sousCategorie => $elements)
                                                        <li data-subcategory="{{ $sousCategorie }}">
                                                            <strong>{{ $sousCategorie }}</strong>
                                                            <ul class="ml-6 space-y-1">
                                                                @foreach($elements as [$element, $sousElement])
                                                                    <li class="flex items-center justify-between" data-element="{{ $element }}" data-sub-element="{{ $sousElement }}">
                                                                        <span>{{ $element }} - {{ $sousElement }}</span>
                                                                        <button 
                                                                            class="delete-produit">
                                                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                                                            </svg>
                                                                        </button>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <label for="details"><h4 class="font-semibold text-gray-700 mb-0 pb-0">Détails</h4></label>
                                    <textarea id="details" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez écrire les détails...">{{ $service->details }}</textarea>
                                </div>
                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="produits-modal" id="save-produits" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Continuer les modifications</button>
                                    <button type="button" id="add-produits" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 ml-2.5 py-2.5 text-center">Ajouter un produit / service</button>
                                    <button data-modal-hide="produits-modal" id="cancel-produits" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            const $productListModal = $('#product-list-modal');
                            const $addProductBtn = $('#add-produits');
                            const $cancelProductBtn = $('#cancel-produits');
                            const $saveProductBtn = $('#save-produits');
                            const $detailsTextareaModal = $('#details');
                            const $produitServicesInput = $('#produit_services');

                            let initialproductListModal = $productListModal.html();
                            let initialDetailsModal = $detailsTextareaModal.val();

                            let produitServices = JSON.parse($produitServicesInput.val() || '[]');

                            function updateProduitServices() {
                                let remainingServices = [];
                                
                                $productListModal.find('li[data-category]').each(function () {
                                    const category = $(this).data('category');

                                    $(this).find('li[data-subcategory]').each(function () {
                                        const subCategory = $(this).data('subcategory');

                                        $(this).find('li[data-element]').each(function () {
                                            const element = $(this).data('element');

                                            remainingServices.push(element);
                                        });
                                    });
                                });

                                produitServices = produitServices.filter(service => 
                                    remainingServices.some(id => service.includes(id.toString()))
                                );

                                $produitServicesInput.val(JSON.stringify(produitServices));
                            }

                            $productListModal.on('click', '.delete-produit', function () {
                                const $productItem = $(this).closest('li');
                                const $subcategory = $productItem.closest('[data-subcategory]');
                                const $category = $productItem.closest('[data-category]');

                                $productItem.remove();

                                if ($subcategory && $subcategory.find('ul > li').length === 0) {
                                    $subcategory.remove();
                                }

                                if ($category && $category.find('[data-subcategory]').length === 0) {
                                    $category.remove();
                                }
                            });

                            $cancelProductBtn.on('click', function () {
                                $productListModal.html(initialproductListModal);
                                $detailsTextareaModal.val(initialDetailsModal);
                                produitServices = JSON.parse($produitServicesInput.val() || '[]');
                            });

                            $saveProductBtn.on('click', function () {
                                initialproductListModal = $productListModal.html();
                                initialDetailsModal = $detailsTextareaModal.val();

                                const $produitsListFieldset = $('#produitsListFieldset');
                                const $detailsFieldset = $('#detailsFieldset');

                                $produitsListFieldset.empty();

                                $productListModal.find('li[data-category]').each(function () {
                                    const $categoryItem = $(this);
                                    const category = $categoryItem.data('category');
                                    const $categoryUl = $('<ul></ul>');
                                    const $categoryLi = $('<li></li>').text(category);
                                    $categoryUl.append($categoryLi);

                                    $categoryItem.find('li[data-subcategory]').each(function () {
                                        const $subCategoryItem = $(this);
                                        const subCategory = $subCategoryItem.data('subcategory');
                                        const $subCategoryUl = $('<ul></ul>').addClass('ml-3');
                                        const $subCategoryLi = $('<li></li>').text(subCategory);
                                        $subCategoryUl.append($subCategoryLi);

                                        const $elementsUl = $('<ul></ul>').addClass('ml-6');
                                        $subCategoryItem.find('li[data-element]').each(function () {
                                            const $elementItem = $(this);
                                            const element = $elementItem.data('element');
                                            const subElement = $elementItem.data('sub-element');
                                            const $elementLi = $('<li></li>').text(`${element} - ${subElement}`);
                                            $elementsUl.append($elementLi);
                                        });

                                        $subCategoryLi.append($elementsUl);
                                        $categoryUl.append($subCategoryUl);
                                    });

                                    $produitsListFieldset.append($categoryUl);
                                });

                                $detailsFieldset.text(initialDetailsModal);

                                updateProduitServices();
                            });
                        });
                    </script>


                    <div class="grid grid-cols-2">
                        <fieldset class="border-2 border-blue-600 rounded-lg p-4 col-span-1">
                        @if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
                            <div class="text-right">
                                <button data-modal-target="brochure-modal" data-modal-toggle="brochure-modal" class="text-blue-600 hover:text-blue-900" type="button">
                                    <i class="text-xl fa-regular fa-pen-to-square" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Brochures et cartes d'affaire</legend>
                        <p class="text-gray-800">
                        <ul>
                            @foreach($brochures as $brochure)
                                <li class="flex items-center mb-2" id="brochureAffiche">
                                    <a href="{{ asset('storage/brochures/' . $brochure->nom) }}"
                                        download="{{ $brochure->nom }}" class="brochureAfficheNom">
                                        
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
                                    <span
                                        class="ml-2 sizeAffiche">{{ number_format(Storage::size('public/brochures/' . $brochure->nom) / 1024, 2) }}
                                        Ko</span>
                                </li>
                            @endforeach
                        </ul>
                        </p>
                        <p id="titreNouveau"></p>
                        <p>
                            <ul id="brochuresNouvelles"></ul>
                        </p>
                        </fieldset>
                    
                        <div>
                        <fieldset class="border-2 border-blue-600 rounded-lg p-4 col-span-2 ml-2">
                            <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Finances</legend>
                            @if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
                                <div class="text-right">
                                    <butto data-modal-target="finance-modal" data-modal-toggle="finance-modal" class="text-blue-600 hover:text-blue-900" type="button">
                                        <i class="text-xl fa-regular fa-pen-to-square" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif
                            @if($fournisseur)
                                <p><span>TPS</span> : {{$fournisseur->numTPS}}</p>
                                <p class="mb-2"><span>TVQ</span> : {{$fournisseur->numTVQ}}</p>
                                <span class="font-bold mt-2">Conditions de paiements</span>
                                <p class="mb-2">{{$fournisseur->conditionPaiement}}</p>
                                <span class="font-bold mt-2">Devises</span>
                                <p class="mb-2">{{$fournisseur->devise}}</p>
                                <span class="font-bold mt-2">Mode de communication</span>
                                <p>{{$fournisseur->modeCommunication}}</p>
                            @endif
                            
                        </fieldset>
                    </div>

                    </div>
                    <div id="finance-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Finances
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="finance-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <div class="p-4 md:p-5 space-y-4">
                                    <div class="grid gap-6 mb-6 md:grid-cols-1">
                                        <div>
                                            <label for="numTPS" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro TPS</label>
                                            <input type="text" name="numTPS" id="numTPS" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->numTPS }}" value="{{ $fournisseur->numTPS }}" />
                                            <p id="numTPSErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un numéro de TPS valide.</p>
                                        </div>
                                        <div>
                                            <label for="numTVQ" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro TVQ</label>
                                            <input type="text" name="numTVQ" id="numTVQ" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->numTVQ }}" value="{{ $fournisseur->numTVQ }}" />
                                            <p id="numTVQErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un numéro de TVQ valide.</p>
                                        </div>
                                        <div>
                                            <label for="conditionPaiement">Conditions de paiement</label>
                                            <select name="conditionPaiement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="conditionPaiement">
                                                <option value="payable immédiatement sans réduction">payable immédiatement sans réduction</option>
                                                <option value="payable immédiatement sans réduction, Date de base au 15 du mois suivant">payable immédiatement sans réduction, Date de base au 15 du mois suivant</option>
                                                <option value="dans les 15 jours 2% escpte, dans les 30 jours sans déduction">dans les 15 jours 2% escpte, dans les 30 jours sans déduction</option>
                                                <option value="après entrée facture jusqu'au 15 du mois, jusqu'au 15 du mois suivant 2% escpte">après entrée facture jusqu'au 15 du mois, jusqu'au 15 du mois suivant 2% escpte</option>
                                                <option value="dans les 10 jours 2% escpte, dans les 30 jours sans déduction">dans les 10 jours 2% escpte, dans les 30 jours sans déduction</option>
                                                <option value="dans les 15 jours sans déduction">dans les 15 jours sans déduction</option>
                                                <option value="dans les 30 jours sans déduction">dans les 30 jours sans déduction</option>
                                                <option value="dans les 45 jours sans déduction">dans les 45 jours sans déduction</option>
                                                <option value="dans les 60 jours sans déduction">dans les 60 jours sans déduction</option>
                                            </select>
                                        </div>
                                        <label for="">Devise</label>
                                        <div class="grid gap-4 md:grid-cols-3">
                                            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                                <input id="CAD" type="radio" value="CAD" name="devise" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="CAD" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">CAD</label>
                                            </div>
                                            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                                <input checked id="USD" type="radio" value="USD" name="devise" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="USD" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">USD</label>
                                            </div>
                                        </div>
                                        <label for="">Mode de communication</label>
                                        <div class="grid gap-4 md:grid-cols-2">
                                            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                                <input id="Courriel" type="radio" value="Courriel" name="modeCommunication" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="Courriel" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Courriel</label>
                                            </div>
                                            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                                <input checked id="Courriel régulier" type="radio" value="Courriel régulier" name="modeCommunication" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="Courriel régulier" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Courriel régulier</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="finance-modal" id="save-adresse" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Continuer les modifications</button>
                                    <button data-modal-hide="finance-modal" id="cancel-adresse" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        var isNumTPSValid = true;
                        var isNumTVQValid = true;
                        var isConditionPaiementValid = true;
                        
                        function validateType(selectElement) {
                            const validValues = ["payable immédiatement sans réduction", 
                                                    "payable immédiatement sans réduction, Date de base au 15 du mois suivant", 
                                                    "dans les 15 jours 2% escpte, dans les 30 jours sans déduction",
                                                    "après entrée facture jusqu'au 15 du mois, jusqu'au 15 du mois suivant 2% escpte",
                                                    "dans les 10 jours 2% escpte, dans les 30 jours sans déduction",
                                                    "dans les 15 jours sans déduction",
                                                    "dans les 30 jours sans déduction",
                                                    "dans les 45 jours sans déduction",
                                                    "dans les 60 jours sans déduction",
                                                ];
                            if (!validValues.includes(selectElement.value)) {
                                $('#' + selectElement.id + '-error').removeClass('hidden');
                                return false;
                            } else {
                                $('#' + selectElement.id + '-error').addClass('hidden');
                                return true;
                            }
                        }

                        document.getElementById('numTPS').addEventListener('input', function() {
                            if (this.value != "") {
                                $('#numTPSErrorMessage').addClass('hidden');
                                isNumTPSValid = true;
                            } else {
                                $('#numTPSErrorMessage').removeClass('hidden');
                                isNumTPSValid = false;
                            }
                            checkAdressFormValidity();
                        });

                        document.getElementById('numTVQ').addEventListener('input', function() {
                            if (this.value != "") {
                                $('#numTVQErrorMessage').addClass('hidden');
                                isNumTVQValid = true;
                            } else {
                                $('#numTVQErrorMessage').removeClass('hidden');
                                isNumTVQValid = false;
                            }
                            checkAdressFormValidity();
                        });
                        
                    </script>

                    <div id="brochure-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        et carte d'affaires
                                    </h3>
                                    <button type="button" id="fermer" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="brochure-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <div class="p-4 md:p-5 space-y-4" id="mainDiv">
                                    <div class="mb-6">
                                        <ul>
                                            @foreach($brochures as $brochure)
                                            <div class="flex justify-around">
                                                <li class="items-center mb-2 mb-4">

                                                    <a href="{{ asset('storage/brochures/' . $brochure->nom) }}"
                                                        download="{{ $brochure->nom }}" class="nomBrochure">
                                                        
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
                                                    <span class="ml-2 size">{{ number_format(Storage::size('public/brochures/' . $brochure->nom) / 1024, 2) }}Ko</span>
                                                
                                                </li>
                                                <button type="button" class="text-gray-400 retirerBrochure bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>                                         
                                            </div>                       
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="flex items-center justify-center w-full">
                                        <label for="brochures" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Cliquer pour importer</span> ou glisser et relâcher</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">DOC, DOCX, PDF, JPG, XLS, XLSX, etc.</p>
                                            </div>
                                            <input type="file" name="brochures[]" id="brochures" class="hidden" onChange="afficherNomFichier()" multiple/>
                                        </label>
                                    </div>                                 
                                </div>
                                <div id="resultat" class="px-4 pb-4">
                                </div>
                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="brochure-modal" id="save-brochures" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Continuer les modifications</button>
                                    <button data-modal-hide="brochure-modal" id="cancel-brochures" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                            newBrochure = document.getElementById("brochures");

                            newBrochure.addEventListener('change', function(){
                                const files = newBrochure.files;
                                const brochuresNouvelles = document.getElementById("brochuresNouvelles");
                                document.getElementById("titreNouveau").innerHTML = "Nouveaux";

                                for(let i = 0; i < files.length; i++){

                                    const li = document.createElement("li");
                                    const lien = document.createElement("a");
                                    const mot = document.createElement("span");

                                    li.classList.add("flex", "items-center", "mb-2");
                                    lien.classList.add("nouvelleBrochure");
                                    mot.classList.add("ml-2", "sizeAffiche");

                                    lien.href = "";
                                    lien.textContent = files[i].name;
                                    mot.textContent = ((files[i].size) / 1000).toFixed(2) + " Ko";
                                    
                                    li.appendChild(lien);
                                    li.appendChild(mot);

                                    brochuresNouvelles.appendChild(li);
                                }
                            })
                        </script>

                    <script>
                        function afficherNomFichier(){
                            var fichier = document.getElementById("brochures").value;
                            const nom = document.createElement("p");

                            nom.innerHTML = fichier;

                            document.getElementById("resultat").appendChild(nom);
                        }

                        let elements = [];
                        const elementsBrochures = document.getElementsByClassName("retirerBrochure");

                        for(let i=0; i<elementsBrochures.length; i++) {
                            elementsBrochures[i].addEventListener('click', function(){
                                const nom = document.getElementsByClassName("nomBrochure");
                                for(let j=0; j<nom.length; j++){
                                    nom[i].style.opacity = "0.2";
                                    elements.push(nom[i].textContent.trim());
                                }

                                const taille = document.getElementsByClassName("size");
                                for(let k=0; k<taille.length; k++){
                                    taille[i].style.opacity = "0.2";
                                }
                            });
                        }
                        const elementsAfficherNom = document.getElementsByClassName("brochureAfficheNom");

                        document.getElementById('save-brochures').addEventListener('click', function(event) {
                            for(let l = elementsAfficherNom.length - 1; l >= 0; l--){
                                if(elements.includes(elementsAfficherNom[l].textContent.trim())){
                                    elementsAfficherNom[l].remove();
                                    document.getElementsByClassName("sizeAffiche")[l].remove();
                                }
                            }
                        });
                        


                        document.getElementById('cancel-brochures').addEventListener('click', function(event) {
                            for(let i=0; i<elementsBrochures.length; i++) {
                                const nom = document.getElementsByClassName("nomBrochure");
                                for(let j=0; j<nom.length; j++){
                                    nom[i].style.opacity = "1";
                                }

                                const taille = document.getElementsByClassName("size");
                                    taille[i].style.opacity = "1";
                                }
                        });

                        document.getElementById('fermer').addEventListener('click', function(event) {
                            for(let i=0; i<elementsBrochures.length; i++) {
                                const nom = document.getElementsByClassName("nomBrochure");
                                for(let j=0; j<nom.length; j++){
                                    nom[i].style.opacity = "1";
                                }

                                const taille = document.getElementsByClassName("size");
                                    taille[i].style.opacity = "1";
                                }
                        });

                        
                    </script>

                    @if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none mt-2">Enregistrer</button>
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none mt-2">Exporter vers les finances</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
@if(Auth::check() && (Auth::user()->role == 'Responsable' || Auth::user()->role == 'Administrateur'))
<form method="POST" class="ml-14" action="{{route('supprimerFournisseur', [$fournisseur->id] )}}">
    @csrf
    @method('DELETE')
    <button type="submit" class="underline mt-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur ?');">Supprimer le fournisseur</button>
</form>  
@endif
@endif

</div>
@endsection
