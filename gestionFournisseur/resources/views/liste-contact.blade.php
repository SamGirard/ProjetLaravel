@extends('layouts.app')
@section('title', "Liste des fournisseurs")
@section('contenu')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="pb-2 pt-5 px-5 flex justify-between items-center">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <caption class="text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            Liste des fournisseurs sélectionnés
        </caption>
    </table>
</div>

<table class="m-5 text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Fournisseur
            </th>
            <th scope="col" class="px-6 py-3">
                Courriel
            </th>
            <th scope="col" class="px-6 py-3">
                Téléphone
            </th>
            <th scope="col" class="px-6 py-3">
                Contacté
            </th>
        </tr>
    </thead>
    <tbody>
        <div id="accordion-collapse" data-accordion="open">
            @foreach($fournisseurs as $fournisseur)
                <tr
                    class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-800">
                    <div>
                        <button type="button" id="heading-{{ $fournisseur->neq }}" aria-expanded="false"
                            data-accordion-target="#body-{{ $fournisseur->neq }}"
                            aria-controls="body-{{ $fournisseur->neq }}">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center w-min">
                                    <svg class="w-5 h-5 text-inherit" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 9-7 7-7-7" />
                                    </svg>
                                    {{ $fournisseur->nomEntreprise }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $fournisseur->courriel }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $fournisseur->numéroTelephone }}
                            </td>
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="{{ $fournisseur->neq }}" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="{{ $fournisseur->neq }}" class="sr-only">checkbox</label>
                                </div>
                            </td>
                        </button>
                    </div>
                    <div id="body-{{ $fournisseur->neq }}" class="hidden" aria-labelledby="heading-{{ $fournisseur->neq }}">
                        @foreach($contacts as $contact)
                            @if($contact->neqFournisseur == $fournisseur->neq)
                                <p>{{ $contact->numTelephone }}</p>
                            @endif
                        @endforeach
                    </div>
                </tr>
            @endforeach
            </div>
        </div>
    </tbody>
</table>

@endsection