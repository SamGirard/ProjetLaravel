@extends('layouts.app')
@section('title', "Liste des fournisseurs")
@section('contenu')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container mx-auto">
    <table class="mx-auto text-sm text-left text-gray-500">
        <caption class="pt-5 px-6 text-lg font-semibold text-left text-gray-900 bg-white">
            Liste des fournisseurs sélectionnés
        </caption>
        <thead class="font-medium text-gray-900">
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col" class="px-6 py-3">Contactés</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fournisseurs as $fournisseur)
                @php
                    $telephoneNumbers = json_decode($fournisseur->numeroTelephone, true);
                        if (!is_array($telephoneNumbers)) {
                            $telephoneNumbers = [$telephoneNumbers];
                        }
                    @endphp
                <tr class="bg-white border-b dark:bg-gray-800" x-data="{ currentContactIndex: 0 }">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $fournisseur->nomEntreprise }}</div>
                        <div class="text-sm">{{ $fournisseur->email }}</div>
                        @for($i = 0; $i < count($telephoneNumbers); $i++)
                        <div class="text-sm">{{ preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $telephoneNumbers[$i]) }}</div>
                        @endfor
                    </td>

                    <td class="px-6 py-4">
                        @php $fournisseurContacts = $contacts->where('fournisseur_id', $fournisseur->id); @endphp
                        <div class="flex">
                            <div class="flex flex-col justify-center items-center space-y-2 mr-2">
                                <button 
                                    @click="currentContactIndex = Math.max(0, currentContactIndex - 1)" 
                                    :disabled="currentContactIndex === 0"
                                    class="rounded hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                    </svg>
                                </button>

                                <button 
                                    @click="currentContactIndex = Math.min({{ $fournisseurContacts->count() - 1 }}, currentContactIndex + 1)" 
                                    :disabled="currentContactIndex === {{ $fournisseurContacts->count() - 1 }}"
                                    class="rounded hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </div>

                            <div>
                                @foreach($fournisseurContacts as $contact)
                                    <div x-show="currentContactIndex === {{ $loop->index }}" class="flex items-center mb-2">
                                        <div class="text-sm">
                                            <div>{{ $contact->prenom }} {{ $contact->nom }}, {{ $contact->fonction }}</div>
                                            <div>{{ $contact->courriel }}</div>
                                            <div>{{ preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $contact->numTelephone) }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </td>

                    <td class="w-4 p-4">
                        <div class="flex justify-center items-center">
                            <input id="{{ $fournisseur->neq }}" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="{{ $fournisseur->neq }}" class="sr-only">checkbox</label>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection