@extends('layouts.app')
@section('title', "Liste des fournisseurs")
@section('contenu')
@php
  #logger('Utilisateur authentifié : ' . Auth::user()->courriel);
@endphp
@vite(['resources/css/app.css','resources/js/app.js'])
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="flex min-h-screen">
    <aside id="sidebar" class="top-0 left-0 z-40 w-64 h-screen mr-5" aria-label="Sidebar">
        <div class="h-full px-2 py-4 overflow-y-auto  bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <ul class="space-y-2 font-medium">

                <button type="button" class="flex items-center w-full p-1 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-segment" data-collapse-toggle="dropdown-segment">
                    <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                    </svg>

                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Produits et Services </span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                        
                <ul id="dropdown-segment" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <div class="p-3">
                            <nav class="flex justify-between">
                                <ol id="breadcrumbs" class="inline-flex items-center mb-3 space-x-1 text-xs text-neutral-500 [&_.active-breadcrumb]:text-neutral-600 [&_.active-breadcrumb]:font-medium sm:mb-0">
                                    <li class="flex items-center h-full">
                                        <a class="inline-flex items-center px-2 py-1.5 space-x-1.5 rounded-md hover:text-neutral-900 hover:bg-neutral-100">
                                            <span>Liste</span>
                                        </a>
                                    </li>  
                                </ol>
                            </nav>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" id="searchSegment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher un service...">
                        </div>
                    </div>
                    <ul id="segment-list" class="h-64 px-3 pb-3 overflow-y-scroll text-sm text-gray-700 dark:text-gray-200">
                    </ul>
                </ul>

                <button type="button" class="flex items-center w-full p-1 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-categorie" data-collapse-toggle="dropdown-categorie">
                    <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 9h6m-6 3h6m-6 3h6M6.996 9h.01m-.01 3h.01m-.01 3h.01M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/>
                    </svg>

                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Catégorie de travaux </span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                    
                <ul id="dropdown-categorie" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <div class="p-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>

                            </div>
                            <input type="text" id="searchCategorie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher une catégorie...">
                        </div>
                    </div>
                    <ul id="categorie-list" class="h-64 px-3 pb-3 overflow-y-scroll text-sm text-gray-700 dark:text-gray-200">
                    @if(count($categoriesLicences))
                        @foreach($categoriesLicences as $categoriesLicence)
                            <h2 class="mb-2 text-base">{{ $categoriesLicence->titre }}</h2>
                                                                    
                            @php
                                $filteredLicences = $licences->where('Categorie', $categoriesLicence->id);
                            @endphp
                                                                    
                            @if(count($filteredLicences))
                                @foreach($filteredLicences as $licence)
                                    <li>
                                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <input id="{{ $licence->Numéro }}" type="checkbox" value="{{ $licence->titre }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="{{ $licence->Numéro }}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{ $licence->titre }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                    </ul>
                </ul>

                <button type="button" class="flex items-center w-full p-1 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-regions" data-collapse-toggle="dropdown-regions">
                    <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8.64 4.737A7.97 7.97 0 0 1 12 4a7.997 7.997 0 0 1 6.933 4.006h-.738c-.65 0-1.177.25-1.177.9 0 .33 0 2.04-2.026 2.008-1.972 0-1.972-1.732-1.972-2.008 0-1.429-.787-1.65-1.752-1.923-.374-.105-.774-.218-1.166-.411-1.004-.497-1.347-1.183-1.461-1.835ZM6 4a10.06 10.06 0 0 0-2.812 3.27A9.956 9.956 0 0 0 2 12c0 5.289 4.106 9.619 9.304 9.976l.054.004a10.12 10.12 0 0 0 1.155.007h.002a10.024 10.024 0 0 0 1.5-.19 9.925 9.925 0 0 0 2.259-.754 10.041 10.041 0 0 0 4.987-5.263A9.917 9.917 0 0 0 22 12a10.025 10.025 0 0 0-.315-2.5A10.001 10.001 0 0 0 12 2a9.964 9.964 0 0 0-6 2Zm13.372 11.113a2.575 2.575 0 0 0-.75-.112h-.217A3.405 3.405 0 0 0 15 18.405v1.014a8.027 8.027 0 0 0 4.372-4.307ZM12.114 20H12A8 8 0 0 1 5.1 7.95c.95.541 1.421 1.537 1.835 2.415.209.441.403.853.637 1.162.54.712 1.063 1.019 1.591 1.328.52.305 1.047.613 1.6 1.316 1.44 1.825 1.419 4.366 1.35 5.828Z" clip-rule="evenodd"/>
                    </svg>

                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Régions administratives </span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                    
                <ul id="dropdown-regions" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <div class="p-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            </div>
                            <input type="text" id="searchRegion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher une régions...">
                        </div>
                    </div>
                    <ul id="region-list" class="h-64 px-3 pb-3 overflow-y-scroll text-sm text-gray-700 dark:text-gray-200">
                    </ul>
                </ul>

                <button type="button" class="flex items-center w-full p-1 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-city" data-collapse-toggle="dropdown-city">
                    <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M10.915 2.345a2 2 0 0 1 2.17 0l7 4.52A2 2 0 0 1 21 8.544V9.5a1.5 1.5 0 0 1-1.5 1.5H19v6h1a1 1 0 1 1 0 2H4a1 1 0 1 1 0-2h1v-6h-.5A1.5 1.5 0 0 1 3 9.5v-.955a2 2 0 0 1 .915-1.68l7-4.52ZM17 17v-6h-2v6h2Zm-6-6h2v6h-2v-6Zm-2 6v-6H7v6h2Z" clip-rule="evenodd"/>
                        <path d="M2 21a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Z"/>
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Villes </span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                    
                <ul id="dropdown-city" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                    <div class="p-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            </div>
                            <input type="text" id="searchCity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher une ville...">
                        </div>
                    </div>
                    <ul id="city-list" class="h-64 px-3 pb-3 overflow-y-scroll text-sm text-gray-700 dark:text-gray-200">
                    </ul>
                </ul>
            </ul>
            </ul>
        </div>
    </aside>

    <div class="relative overflow-x-auto sm:rounded-lg max-w-screen-xl w-full">
        <div class="pb-2 pt-5 flex justify-between items-center">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="pr-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Liste des fournisseurs
                </caption>
            </table>
        </div>
        <div class="mt-1 pb-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search" class="block p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher un fournisseur...">
                </div>

                <select id="itemsPerPage" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1">1</option>
                    <option selected value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="75">75</option>
                    <option value="100">100</option>
                </select>
                <label for="itemsPerPage" class="ml-1 block text-sm font-medium text-gray-900 dark:text-white">fournisseurs par page</label>
            </div>

            <div class="flex items-center space-x-2">
                <button id="open-list" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Liste des fournisseurs sélectionnés
                </button>
                <button type="button" class="flex-shrink-0 z-10 inline-flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm py-2.5 px-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 hover:text-blue-600">
                    <svg class="w-5 h-5 pr-1 text-inherit" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0-12 4 4m-4-4L8 8"/>
                    </svg>
                    Exporter
                </button>
            </div>
        </div>
        <div class="border-t border-gray-200 dark:border-gray-700 pb-4"></div>
            <div class="flex pb-4">
                <div class="flex items-center me-4">
                    <input id="En attente" type="checkbox" value="" class="statusCheckbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="En attente" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">En attente</label>
                </div>
                <div class="flex items-center me-4">
                    <input checked id="Accepter" type="checkbox" value="" class="statusCheckbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="Accepter" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Acceptées</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="Refusé" type="checkbox" value="" class="statusCheckbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="Refusé" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Refusées</label>
                </div>
                <div class="flex items-center me-4">
                    <input id="Réviser" type="checkbox" value="" class="statusCheckbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="Réviser" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">À réviser</label>
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            État
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fournisseurs
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ville
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Produits et services
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Catégories de travaux
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fiche fournisseur
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sélectionner
                        </th>
                    </tr>
                </thead>
                <tbody id="fournisseurs-list">
                </tbody>
            </table>
            <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Affichage de <span id="nbAffichage" class="font-semibold text-gray-900 dark:text-white">1-10</span> sur <span id="nbAffichageTotal" class="font-semibold text-gray-900 dark:text-white">{{count($fournisseurs)}}</span></span>
                <ul id="pagination"class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                    <p>allo</p>
                </ul>
            </nav>
    </div>

    <script>
    $(document).ready(function() {
        let selectedRegions = new Set();
        let currentCities = new Set();
        let startingComodities = 0;
        let firstLoad = false;
        let checkedRegions = filterFournisseursOnUpdate({});
        let checkedCities = filterFournisseursOnUpdate({});
        let checkedLicences = filterFournisseursOnUpdate({});
        let checkedCommodities = filterFournisseursOnUpdate({});
        var categoriesLicences = @json($categoriesLicences);
        var licences = @json($licences);
        var fournisseurs = @json($fournisseurs);
        var demandes = @json($demandes);
        var infosRbq = @json($infosRbq);
        var checkedStatus = {};
        checkedStatus['Accepter'] = true;
        var allCities = [];
        var currentPage = 1;
        var itemsPerPage = $('#itemsPerPage').val();
        var filteredFournisseurs = [];

        $.ajax({
            url: '/ville',
            method: 'GET',
            success: function(data) {
                $.each(data.result.records, function(index, item) {
                    allCities.push({
                        key: item.munnom,
                        value: item.regadm
                    });
                });

            },
            error: function() {
                alert('Failed to fetch city.');
            }
        });

        function filterFournisseursOnUpdate(obj) {
            return new Proxy(obj, {
                set(target, property, value) {
                    target[property] = value;
                    filterFournisseurs();
                    return true;
                }
            });
        }

        let isSearching = false;
        let debounceTimer;
        const segmentPerPage = 100;

        function onInputCommodities() {
            firstLoad = false;
            clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    startingComodities = 0;
                    searchCommodities();
                }, 300);
            document.getElementById('segment-list').scrollTop = 0;
        }

        function searchCommodities() {
            if (isSearching) return;

            isSearching = true;
            let searchQuery = $('#searchSegment').val().toLowerCase();

            let url = '/comoditySearch/' + startingComodities + '/' + segmentPerPage;
            if (searchQuery !== '') {
                url += '?comodity=' + encodeURIComponent(searchQuery);
            }

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    let segmentList = $('#segment-list');
                    if (!firstLoad) {
                        segmentList.empty();
                        firstLoad = true;
                    }

                    let items = [];

                    $.each(data, function(index, item) {
                            let isChecked = checkedCommodities[item] ? 'checked' : '';
                            items.push(`
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input id="${item}" type="checkbox" value="${item}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" ${isChecked}>
                                        <label for="${item}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${item}</label>
                                    </div>
                                </li>
                            `);
                    });

                    segmentList.append(items.join(''));
                },
                error: function() {
                    alert('Failed to fetch segment.');
                },
                complete: function() {
                    isSearching = false;
                }
            });
        }

        $('#segment-list').on('change', 'input[type="checkbox"]', function() {
            checkedCommodities[this.id] = $(this).is(':checked');
        });

        function handleScroll() {
            const element = document.getElementById('segment-list');
            const scrollTop = element.scrollTop;
            const scrollHeight = element.scrollHeight;
            const clientHeight = element.clientHeight;
            const scrollPercentage = (scrollTop / (scrollHeight - clientHeight)) * 100;

            if (scrollPercentage > 80) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    startingComodities += itemsPerPage;
                    searchCommodities();
                }, 100);
            }
        }

        function loadRegions() {
            let searchQuery = $('#searchRegion').val().trim().toLowerCase();
            let regex = new RegExp(searchQuery, 'i');

            $.ajax({
                url: '/regions',
                method: 'GET',
                success: function(data) {
                    let regionList = $('#region-list');
                    regionList.empty();
                    let items = [];

                    $.each(data.result.records, function(index, item) {
                        let regionName = item.regadm;
                        if (searchQuery === "" || regex.test(regionName)) {
                            let isChecked = checkedRegions[regionName] ? 'checked' : '';
                            items.push(`
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input id="${regionName}" type="checkbox" value="${regionName}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" ${isChecked}>
                                        <label for="${regionName}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${regionName}</label>
                                    </div>
                                </li>
                            `);
                        }
                    });

                    regionList.append(items.join(''));

                },
                error: function() {
                    alert('Failed to fetch regions.');
                }
            });
        }

        $('#region-list').on('change', 'input[type="checkbox"]', function() {
            checkedRegions[this.id] = $(this).is(':checked');
            filterCities();
        });

        function loadCities(region, callback) {
            $.ajax({
                url: '/ville/' + encodeURIComponent(region),
                method: 'GET',
                success: callback,
                error: function() {
                    alert('Failed to fetch cities for region: ' + region);
                }
            });
        }

        function filterCities() {
            let selectedRegions = $('#region-list input:checked').map(function() {
                return $(this).val();
            }).get();
            
            let searchQuery = $('#searchCity').val().trim().toLowerCase();
            let regex = new RegExp(searchQuery, 'i');
            let cityList = $('#city-list');
            cityList.empty();

            if (selectedRegions.length > 0) {
                let loadedCities = new Set();
                let remainingRegions = selectedRegions.length;
                let cityItems = [];

                selectedRegions.forEach(region => {
                    loadCities(region, function(data) {
                        $.each(data.result.records, function(index, item) {
                            let cityName = item.munnom.toLowerCase();
                            if (!loadedCities.has(cityName) && (searchQuery === "" || regex.test(cityName))) {
                                loadedCities.add(cityName);
                                let isChecked = checkedCities[cityName] ? 'checked' : '';
                                cityItems.push(`
                                    <li>
                                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <input id="${cityName}" type="checkbox" value="${item.munnom}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" ${isChecked}>
                                            <label for="${cityName}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${item.munnom}</label>
                                        </div>
                                    </li>
                                `);
                            }
                        });

                        remainingRegions--;
                        if (remainingRegions === 0) {
                            cityList.append(cityItems.join(''));
                            cityList.removeClass('hidden');
                        }
                    });
                });
            } else {
                $.ajax({
                    url: '/ville',
                    method: 'GET',
                    success: function(data) {
                        let cityItems = [];
                        $.each(data.result.records, function(index, item) {
                            let cityName = item.munnom.toLowerCase();
                            if (searchQuery === "" || regex.test(cityName)) {
                                let isChecked = checkedCities[cityName] ? 'checked' : '';
                                cityItems.push(`
                                    <li>
                                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <input id="${cityName}" type="checkbox" value="${item.munnom}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" ${isChecked}>
                                            <label for="${cityName}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${item.munnom}</label>
                                        </div>
                                    </li>
                                `);
                            }
                        });

                        cityList.append(cityItems.join(''));
                        cityList.toggleClass('hidden', cityItems.length === 0);
                    },
                    error: function() {
                        alert('Failed to fetch all cities.');
                    }
                });
            }
        }

        $('#city-list').on('change', 'input[type="checkbox"]', function() {
            checkedCities[this.id] = $(this).is(':checked');
        });


        function filterLicences() {
            let searchValue = $('#searchCategorie').val().toLowerCase();
            let regex = new RegExp(searchValue, 'i');
            $("#categorie-list").empty();

            if (searchValue === "") {
                categoriesLicences.forEach(category => {
                    $("#categorie-list").append(`<h2 class="mb-2 text-base">${category.titre}</h2>`);

                    let filteredLicences = licences.filter(licence => licence.Categorie === category.id);
                    
                    if (licences.length > 0) {
                        filteredLicences.forEach(licence => {
                            licenceItem = $(`
                                        <li>
                                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input id="${ licence.Numéro }" type="checkbox" value="${ licence.titre }" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="${ licence.Numéro }" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${ licence.titre }</label>
                                            </div>
                                        </li>
                            `);

                            if (checkedLicences[licence.id]) {
                                licenceItem.find('input').prop('checked', true);
                            }

                            licenceItem.find('input').change(function() {
                                checkedLicences[this.id] = $(this).is(':checked');
                            });
                                    
                            $("#categorie-list").append(licenceItem);
                        });
                    }
                });
            } else {
                categoriesLicences.forEach(category => {
                        let filteredLicences = licences.filter(licence => licence.Categorie === category.id && regex.test(licence.titre));
                        if (filteredLicences.length > 0) {
                            $("#categorie-list").append(`<h2 class="mb-2 text-base">${category.titre}</h2>`);
                            filteredLicences.forEach(licence => {
                                licenceItem = $(`
                                        <li>
                                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input id="${licence.Numéro}" type="checkbox" value="${licence.titre}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="${licence.Numéro}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${licence.titre}</label>
                                            </div>
                                        </li>
                                `);

                                if (checkedLicences[licence.id]) {
                                    licenceItem.find('input').prop('checked', true);
                                }

                                licenceItem.find('input').change(function() {
                                    checkedLicences[this.id] = $(this).is(':checked');
                                });

                                $("#categorie-list").append(licenceItem);
                            });
                        }
                });
            }
        }

        document.querySelectorAll('.statusCheckbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const value = this.id;

                if (this.checked) {
                    checkedStatus[value] = true;
                } else {
                    delete checkedStatus[value];
                }

                filterFournisseurs();
            });
        });

        $('#itemsPerPage').on('change', function() {
                itemsPerPage = $(this).val();
                changePage(1)
        });

        function renderPagination(totalPages) {
            const maxPagesToShow = 5;
            let startPage = currentPage - Math.floor(maxPagesToShow / 2);
            let endPage = currentPage + Math.floor(maxPagesToShow / 2);

            if (startPage < 1) {
                startPage = 1;
                endPage = Math.min(maxPagesToShow, totalPages);
            }
            if (endPage > totalPages) {
                endPage = totalPages;
                startPage = Math.max(1, totalPages - maxPagesToShow + 1);
            }

            $('#pagination').empty();

            $('#pagination').append(`
                <li>
                    <a class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" 
                        ${currentPage === 1 ? 'class="disabled"' : ''} 
                        data-page="${currentPage - 1}"><</a>
                </li>
            `);

            for (let i = startPage; i <= endPage; i++) {
                let li;
                if (i === currentPage) {
                    li = `<li>
                        <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white" data-page="${i}">${i}</a>
                    </li>`;
                } else {
                    li = `<li>
                        <a class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" data-page="${i}">${i}</a>
                    </li>`;
                }
                $('#pagination').append(li);
            }

            $('#pagination').append(`
                <li>
                    <a class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" 
                        ${currentPage === totalPages ? 'class="disabled"' : ''} 
                        data-page="${currentPage + 1}">></a>
                </li>
            `);

            $('#pagination').on('click', 'a', function(event) {
                event.preventDefault();
                const page = $(this).data('page');
                if (page) {
                    changePage(page);
                }
            });
        }

        function changePage(page) {
            const totalPages = Math.ceil(filteredFournisseurs.length / itemsPerPage);

            if (page < 1 || page > totalPages) return;

            currentPage = page;
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + Number(itemsPerPage);
            const currentFournisseurs = filteredFournisseurs.slice(startIndex, endIndex);

            $('#nbAffichage').text(`${startIndex + 1}-${Math.min(endIndex, filteredFournisseurs.length)}`);

            renderPagination(totalPages);
            renderFournisseur(currentFournisseurs);
        }

        function filterFournisseurs() {
            let searchValue = $('#table-search').val();
            let regex = new RegExp(searchValue, 'i');
            
            function nameVerification(name) {
                return searchValue === "" || regex.test(name);
            }

            function statusVerification(status) {
                return checkedStatus[status[0].etatDemande] === true
            }

            function commoditiesVerification(commodities) {
                var isChecked = false;

                commodities.forEach(commodity => {
                    console.log(commodity);
                    compteurCommodities++;
                })

                return !Object.values(checkedCommodities).includes(true) || isChecked;
            }

            function licencesVerification(infosRbq) {
                var isChecked = false;

                infosRbq.forEach(infoRbq => {
                    if(checkedLicences[infoRbq.codeSousCategorie] === true) {
                        isChecked = true;
                        compteurLicences++;
                    }
                })

                return !Object.values(checkedLicences).includes(true) || isChecked;
            }

            function citiesVerification(city) {
                return !Object.values(checkedCities).includes(true) || checkedCities[city.toLowerCase()] === true;
            }

            function regionsVerification(city) {
                const region = allCities.find(c => c.key === city)?.value;

                return !Object.values(checkedRegions).includes(true) || checkedRegions[region] === true;
            }
            
            filteredFournisseurs = fournisseurs.filter(f => 
                nameVerification(f.name) &&
                statusVerification(demandes.filter(d => d.neqFournisseur === f.neq)) &&
                licencesVerification(infosRbq.filter(i => i.neqFournisseur === f.neq)) && 
                citiesVerification(f.ville) &&
                regionsVerification(f.ville)
            );

            const totalPages = Math.ceil(filteredFournisseurs.length / itemsPerPage);
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const currentFournisseurs = filteredFournisseurs.slice(startIndex, endIndex);

            $('#nbAffichage').text(`${startIndex + 1}-${Math.min(endIndex, filteredFournisseurs.length)}`);
            $('#nbAffichageTotal').text(filteredFournisseurs.length);

            renderPagination(totalPages);
            renderFournisseur(currentFournisseurs);
        }

        function renderFournisseur(currentFournisseurs) {
            $('#fournisseurs-list').empty();

            let compteurCommodities = 0;
            let compteurLicences = 0;

            currentFournisseurs.forEach(fournisseur => {
                var etat = demandes.find(d => d.neqFournisseur === fournisseur.neq).etatDemande;

                switch (etat) {
                    case "Accepter":
                        etat = '<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Acceptée</span>';
                        break;
                    case "Refusé":
                        etat = '<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Refusé</span>';
                        break;
                    case "Réviser":
                        etat = '<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">À réviser</span>'
                        break;
                    case "En attente":
                        etat = '<span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">En attente</span>'
                        break;
                }

                fournisseurItem = $(`
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        ${etat}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        ${fournisseur.nomEntreprise}
                    </th>
                    <td class="px-6 py-4">
                        ${fournisseur.ville}
                    </td>
                    <td class="px-6 py-4">
                        ${compteurCommodities}/${Object.values(checkedCommodities).filter(value => value === true).length}
                    </td>
                    <td class="px-6 py-4">
                        ${compteurLicences}/${Object.values(checkedLicences).filter(value => value === true).length}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ouvrir</a>
                    </td>
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                </tr>
                `);

                $('#fournisseurs-list').append(fournisseurItem);
            })
        }

        function debounce(func, wait) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        loadRegions();
        filterCities();
        filterLicences();
        filterFournisseurs();
        searchCommodities();

        const debouncedFilterCities = debounce(filterCities, 300);
        const debouncedLoadRegions = debounce(loadRegions, 300);

        $('#searchCity').on('input', debouncedFilterCities);
        $('#searchRegion').on('input', debouncedLoadRegions);
        $('#searchSegment').on('input', onInputCommodities);
        $('#segment-list').on('scroll', handleScroll);
        $('#searchCategorie').on('input', filterLicences);
        $('#table-search').on('input', filterFournisseurs);
    });

</script>

@endsection