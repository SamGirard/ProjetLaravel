@extends('layouts.app')
@section('title', "Liste des fournisseurs")
@section('contenu')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/f25f0490b7.js" crossorigin="anonymous"></script>

<form method="POST" action="{{route('updateFiche', [$fournisseur->id]) }}">
    @csrf
    @method('PATCH')
    <div class="container mx-auto mt-6 flex">
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6 ml-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">Fiche fournisseur - {{ $fournisseur->nomEntreprise }}</h1>
            <div class="flex justify-evenly">
                <div class="mx-1">
                    @php
                        $statuses = ['Accepter', 'Refusé', 'En attente', 'Réviser'];
                    @endphp

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Statut de la demande</legend>
                        <p class="text-gray-800">
                            @if(in_array($fournisseur->etatDemande, $statuses))
                                    <input type="hidden" name="etatDemande" id="etatDemande"
                                        value="{{ $fournisseur->etatDemande }}">
                                    <button id="dropdownEtatButton" data-dropdown-toggle="dropdownEtat"
                                        class="text-center inline-flex items-center 
                                                {{ $fournisseur->etatDemande == 'En attente' ? 'bg-blue-100 text-blue-800' : ($fournisseur->etatDemande == 'Accepter' ? 'bg-green-100 text-green-800' : ($fournisseur->etatDemande == 'Réviser' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}
                                                text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300" type="button">
                                        {{ $fournisseur->etatDemande }}
                                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                <div id="dropdownEtat" class="hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                    <ul class="p-2" aria-labelledby="dropdownEtatButton">
                                        @foreach($statuses as $status)
                                            @if($status !== $fournisseur->etatDemande)
                                                <li>
                                                    <span
                                                        class="changeStatusButton {{ $status == 'Accepter' ? 'bg-green-100 text-green-800' : ($status == 'En attente' ? 'bg-blue-100 text-blue-800' : ($status == 'Refusé' ? 'refusedButton bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }} 
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
                                        placeholder="Raison du refus...">{{ $fournisseur->raisonRefus }}</textarea>

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
                            `).removeClass().addClass(`text-center inline-flex items-center text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 ${statusClasses[newStatus]}`);

                            $('#etatDemande').attr('value', newStatus);

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
                    <div class="text-right">
                        <button data-modal-target="identification-modal" data-modal-toggle="identification-modal" class="text-blue-600 hover:text-blue-900" type="button">
                            <i class="text-xl fa-regular fa-pen-to-square"></i>
                        </button>
                    </div>
                    <p id="neq-display" class="text-gray-800">{{ $fournisseur->neq }}</p>
                    <p id="nomEntreprise-display" class="text-gray-800">{{ $fournisseur->nomEntreprise }}</p>
                    <p id="email-display" class="text-gray-800">{{ $fournisseur->email }}</p>
                </fieldset>

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
                                        <input type="text" id="neq" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->neq }}" value="{{ $fournisseur->neq }}" />
                                        <p id="neqErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un neq valide.</p>
                                    </div>
                                    <div>
                                        <label for="nomEntreprise" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de l'entreprise</label>
                                        <input type="text" id="nomEntreprise" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->nomEntreprise }}" value="{{ $fournisseur->nomEntreprise }}" required />
                                        <p id="nomErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un nom.</p>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse courriel</label>
                                    <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->email }}" value="{{ $fournisseur->email }}" required />
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

                    <fieldset id="contacts-fieldset" class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Contacts</legend>
                        <div class="text-right">
                        <button data-modal-target="contact-modal" data-modal-toggle="contact-modal" class="text-blue-600 hover:text-blue-900" type="button">
                            <i class="text-xl fa-regular fa-pen-to-square"></i>
                        </button>
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
                                    <p class="text-gray-800">{{ $contact->numTelephone }} #{{ $contact->poste }}</p>
                                </div>
                            </div>
                            <hr class="border-0 h-1 bg-blue-600 my-2">
                        @endforeach
                    </fieldset>

                    <div id="contact-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Contacts
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="contact-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <div class="p-4 md:p-5 space-y-4">
                                    <div id="accordion-contact" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
                                        @foreach($contacts as $contact)
                                            <h2 id="accordion-contact-heading-{{ $contact->id }}">
                                                <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-contact-body-{{ $contact->id }}" aria-expanded="false" aria-controls="accordion-contact-body-{{ $contact->id }}">
                                                <span>{{ $contact->nom }}, {{ $contact->prenom }}</span>
                                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                                </svg>
                                                </button>
                                            </h2>
                                            <div id="accordion-contact-body-{{ $contact->id }}" class="hidden" aria-labelledby="accordion-contact-heading-1">
                                                <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                                    <div class="contact-accordion-grid grid gap-6 mb-6 md:grid-cols-2">
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                                            <input type="text" id="nom-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->nom }}" value="{{ $contact->nom }}" required />
                                                            <p id="nom-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un nom valide</p>
                                                        </div>
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                                            <input type="text" id="prenom-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->prenom }}" value="{{ $contact->prenom }}" required />
                                                            <p id="prenom-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un prénom valide</p>
                                                        </div>
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fonction</label>
                                                            <input type="text" id="fonction-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->fonction }}" value="{{ $contact->fonction }}" required />
                                                            <p id="fonction-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une fonction valide</p>
                                                        </div>  
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de téléphone</label>
                                                            <input type="text" id="numTelephone-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->numTelephone }}" value="{{ $contact->numTelephone }}" required />
                                                            <p id="numTelephone-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un numéro de téléphone valide</p>
                                                        </div>
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type de numéro</label>
                                                            <select id="typeNumTelephone-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                <option value="Bureau" <?= $contact->typeNumTelephone == 'Bureau' ? 'selected' : '' ?>>Bureau</option>
                                                                <option value="Télécopieur" <?= $contact->typeNumTelephone == 'Télécopieur' ? 'selected' : '' ?>>Télécopieur</option>
                                                                <option value="Cellulaire" <?= $contact->typeNumTelephone == 'Cellulaire' ? 'selected' : '' ?>>Cellulaire</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Poste</label>
                                                            <input type="text" id="poste-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->poste }}" value="{{ $contact->poste }}"  required />
                                                            <p id="poste-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un poste valide</p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-6">
                                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Courriel</label>
                                                        <input type="email" id="courriel-contact-{{ $contact->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->courriel }}" value="{{ $contact->courriel }}" required />
                                                        <p id="courriel-contact-error-{{ $contact->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un courriel valide</p>
                                                    </div> 
                                                    <button id="delete-contact-{{ $contact->id }}" type="button" class="delete-contact-btn text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" data-contact-id="{{ $contact->id }}">
                                                        Supprimer
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
                                                <input type="text" id="nom-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un nom..." required />
                                                <p id="nom-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un nom valide</p>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                                <input type="text" id="prenom-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un prénom..." required />
                                                <p id="prenom-contact-error-${contact.id }" class="contact-error mt-2 hidden text-sm text-red-600 dark:text-red-500">Veuillez entrer un prénom valide</p>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fonction</label>
                                                <input type="text" id="fonction-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer une fonction..." required />
                                                <p id="fonction-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une fonction valide</p>
                                            </div>  
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de téléphone</label>
                                                <input type="text" id="numTelephone-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un numéro de téléphone..." required />
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
                                                <input type="text" id="poste-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer le poste du numéro..." required />
                                                <p id="poste-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un poste valide</p>
                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Courriel</label>
                                            <input type="email" id="courriel-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un courriel..." required />
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
                                                <input type="text" id="nom-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un nom..." required value="${contact.nom}" />
                                                <p id="nom-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un nom valide</p>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prénom</label>
                                                <input type="text" id="prenom-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un prénom..." required  value="${contact.prenom}" />
                                                <p id="prenom-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un prénom valide</p>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fonction</label>
                                                <input type="text" id="fonction-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer une fonction..."  value="${contact.fonction}" required />
                                                <p id="fonction-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une fonction valide</p>
                                            </div>  
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de téléphone</label>
                                                <input type="text" id="numTelephone-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un numéro de téléphone..." required  value="${contact.numTelephone}" />
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
                                                <input type="text" id="poste-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer le poste du numéro..." required  value="${contact.poste}" />
                                                <p id="poste-contact-error-${contact.id }" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un poste valide</p>
                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Courriel</label>
                                            <input type="email" id="courriel-contact-${contact.id}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Veuillez entrer un courriel..." required  value="${contact.courriel}"/>
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
                                        <p class="text-gray-800">${contact.numTelephone} #${contact.poste}</p>
                                    `;
                                    contactDiv.appendChild(detailsDiv);

                                    fieldset.appendChild(contactDiv);
                                    const hr = document.createElement("hr");
                                    hr.className = "border-0 h-1 bg-blue-600 my-2";
                                    fieldset.appendChild(hr);
                                });
                        });
                    </script>

                    <fieldset class="border-2 border-blue-600 rounded-lg p-4 mt-2">
                        <legend class="text-lg font-semibold text-blue-600 bg-white px-2">Adresse</legend>
                        <div class="text-right">
                            <button data-modal-target="adresse-modal" data-modal-toggle="adresse-modal" class="text-blue-600 hover:text-blue-900" type="button">
                                <i class="text-xl fa-regular fa-pen-to-square"></i>
                            </button>
                        </div>
                        <p class="text-gray-800 my-1">{{ $fournisseur->numCivique }}
                            , {{ $fournisseur->rue }}</p>
                        <p class="text-gray-800 my-1">{{trim($fournisseur->ville, '"') }}
                            ({{ $fournisseur->province }}) {{ $fournisseur->codePostal }}</p>
                        <p class="text-gray-800 my-1"><a target="_blank"
                                href="{{ $fournisseur->siteInternet }}">{{ $fournisseur->siteInternet }}</a>
                        </p>
                        @php
                            $telephoneNumbers = json_decode($fournisseur->numeroTelephone, true);
                            $typeNumTelephone = json_decode($fournisseur->typeNumTelephone, true);
                            $poste = json_decode($fournisseur->poste, true);
                        @endphp

                        @for($i = 0; $i < count($telephoneNumbers); $i++)
                            <p class="text-gray-800 my-1">
                                @if(isset($typeNumTelephone[$i]) && $typeNumTelephone[$i] == "Telecopieur")
                                    <i class="fa-solid fa-fax mr-2"></i>
                                @elseif(isset($typeNumTelephone[$i]) && $typeNumTelephone[$i] == "Cellulaire")
                                    <i class="fa-solid fa-phone mr-2"></i>
                                @else
                                    <i class="fa-solid fa-desktop mr-2"></i>
                                @endif
                                {{ $telephoneNumbers[$i] }} @isset($poste[$i]) #{{ $poste[$i] }} @endisset
                            </p>
                        @endfor
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
                                            <input type="text" id="numCivique" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->numCivique }}" value="{{ $fournisseur->numCivique }}" />
                                            <p id="numCiviqueErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un numéro civique valide.</p>
                                        </div>
                                        <div>
                                            <label for="rue" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rue</label>
                                            <input type="text" id="rue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->rue }}" value="{{ $fournisseur->rue }}" required />
                                            <p id="rueErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une rue valide.</p>
                                        </div>
                                        <div>
                                            <label for="ville" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ville</label>
                                            <input type="text" id="ville" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->ville }}" value="{{ $fournisseur->ville }}" required />
                                            <p id="villeErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une ville valide.</p>
                                        </div>
                                        <div>
                                            <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                                            <input type="text" id="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->province }}" value="{{ $fournisseur->province }}" required />
                                            <p id="provinceErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer une province valide.</p>
                                        </div>
                                        <div>
                                            <label for="codePostal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code postal</label>
                                            <input type="text" id="codePostal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->codePostal }}" value="{{ $fournisseur->codePostal }}" required />
                                            <p id="codePostalErrorMessage" class="hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un code postal valide.</p>
                                        </div>
                                        <div>
                                            <label for="siteInternet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Site internet</label>
                                            <input type="url" id="siteInternet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->siteInternet }}" value="{{ $fournisseur->siteInternet }}" required />
                                        </div>
                                            <div class="border-t border-gray-200">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de téléphone</label>
                                                <input type="text" id="numTelephone-contact-{{ $fournisseur->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $fournisseur->numTelephone }}" value="{{ $fournisseur->numTelephone }}" required />
                                                <p id="numTelephone-contact-error-{{ $fournisseur->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un numéro de téléphone valide</p>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type de numéro</label>
                                                <select id="typeNumTelephone-contact-{{ $fournisseur->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="Bureau" <?= $fournisseur->typeNumTelephone == 'Bureau' ? 'selected' : '' ?>>Bureau</option>
                                                    <option value="Télécopieur" <?= $fournisseur->typeNumTelephone == 'Télécopieur' ? 'selected' : '' ?>>Télécopieur</option>
                                                    <option value="Cellulaire" <?= $fournisseur->typeNumTelephone == 'Cellulaire' ? 'selected' : '' ?>>Cellulaire</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Poste</label>
                                                <input type="text" id="poste-contact-{{ $fournisseur->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $contact->fournisseur }}" value="{{ $contact->fournisseur }}"  required />
                                                <p id="poste-contact-error-{{ $fournisseur->id }}" class="contact-error hidden mt-2 text-sm text-red-600 dark:text-red-500">Veuillez entrer un poste valide</p>
                                            </div>  
                                    </div>
                                </div>
                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="adresse-modal" id="save-adresse" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Continuer les modifications</button>
                                    <button data-modal-hide="adresse-modal" id="cancel-adresse" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mx-1">

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
                            foreach ($services as $service) {
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
                                    <a href="{{ asset('storage/brochures/' . $brochure->nom) }}"
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
                                    <span
                                        class="ml-2">{{ number_format(Storage::size('public/brochures/' . $brochure->nom) / 1024, 2) }}
                                        Ko</span>
                                </li>
                            @endforeach
                        </ul>
                        </p>
                    </fieldset>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none mt-2">Enregistrer</button>
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none mt-2">Exporter vers les finances</button>
                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none mt-2">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection