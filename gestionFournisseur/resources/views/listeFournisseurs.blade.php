<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<div class="flex min-h-screen">
    <aside id="sidebar" class="top-0 left-0 z-40 w-64 h-screen" aria-label="Sidebar">
        <div class="h-full px-2 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
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
                    <div id="commodity-list" class="hidden h-64 overflow-y-scroll bg-white rounded shadow p-4 mt-4">
                                                                    <div id="commodity-items" class="space-y-2"></div>
                                                                    <button 
                                                                        id="delete-checked" 
                                                                        class="w-full mt-4 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                                                                    >
                                                                        Enlever du filtre
                                                                    </button>
                                                                </div>
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
                            <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
  <path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z" clip-rule="evenodd"/>
</svg>

                            </div>
                            <input type="text" id="searchCategorie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher une ville...">
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
                                            <input id="{{ $licence->id }}" type="checkbox" value="{{ $licence->titre }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="{{ $licence->id }}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{ $licence->titre }}</label>
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

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="pb-4 bg-white dark:bg-gray-900">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
        </div>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
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
</div>
</div>

<script>
$(document).ready(function() {
    let addedCommodities = new Set();
    let selectedRegions = new Set();
    let currentCities = new Set();
    let startingComodities = 0;
    let firstLoad = false;
    let checkedRegions = {};
    let checkedCities = {};
    let checkedLicences = {};
    var categoriesLicences = @json($categoriesLicences);
    var licences = @json($licences);
    var fournisseurs = @json($fournisseurs);

    function onInputCommodities() {
        startingComodities = 0;
        firstLoad = false;
        searchCommodities();
        document.getElementById('segment-list').scrollTop = 0;
    }

    function searchCommodities() {
        let searchQuery = $('#searchSegment').val().toLowerCase();

        if(searchQuery === "") {
            loadSegments('/segment', 'family');
        }
        else{
            $('#breadcrumbs').children('li:not(:first)').remove();
            $.ajax({
            url: '/comoditySearch/' + searchQuery + '/' + startingComodities + '/50',
            method: 'GET',
            success: function(data) {
                let segmentList = $('#segment-list');
                if(!firstLoad) {
                    segmentList.empty();
                    firstLoad = true;
                }

                data.forEach(item => {
                    let itemName = item.split(' ')[0];
                    let itemElement = $('<div></div>')
                        .addClass('p-2 cursor-pointer hover:bg-gray-200')
                        .text(item)
                        .click(function() {
                            addCommodity(item);
                        });
                    
                    segmentList.append(itemElement);
                });
            },
            error: function() {
                alert('Failed to fetch data.');
            }
        });
        }
    }

    function handleScroll() {
        let searchQuery = $('#searchSegment').val().toLowerCase();

        if(searchQuery != "") {
            const element = document.getElementById('segment-list');
            const scrollTop = element.scrollTop;
            const scrollHeight = element.scrollHeight;
            const clientHeight = element.clientHeight;
            const scrollPercentage = (scrollTop / (scrollHeight - clientHeight)) * 100;

            if(scrollPercentage > 50) {
                startingComodities+=50;
                searchCommodities();
            }

        }
    }

    function loadSegments(url, nextUrlPart = null, breadcrumbName = null) {
        $('#searchSegment').val('');
        $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                let segmentList = $('#segment-list');
                segmentList.empty();

                data.forEach(item => {
                    let itemName = item.split(' ')[0];
                    let itemElement = $('<div></div>')
                        .addClass('p-2 cursor-pointer hover:bg-gray-200')
                        .text(item)
                        .click(function() {
                            if (nextUrlPart) {
                                let nextUrl = `/${nextUrlPart}/${itemName}`;
                                loadSegments(nextUrl, nextNextUrlPart(nextUrlPart), itemName);
                            } else {
                                addCommodity(item);
                            }
                        });
                    
                    segmentList.append(itemElement);
                });

                if (breadcrumbName) {
                    addBreadcrumb(breadcrumbName, url, nextUrlPart);
                }
            },
            error: function() {
                alert('Failed to fetch data.');
            }
        });
    }

    function nextNextUrlPart(currentPart) {
        switch (currentPart) {
            case 'family': return 'class';
            case 'class': return 'comodity';
            default: return '';
        }
    }

    function addBreadcrumb(name, url, nextUrlPart) {
        let breadcrumbs = $('#breadcrumbs');
        let breadcrumbItem = $('<li></li>')
            .addClass('flex items-center h-full')
            .attr('data-url', url)
            .attr('data-next', nextUrlPart)
            .html(`<a class="inline-flex items-center px-2 py-1.5 space-x-1.5 rounded-md hover:text-neutral-900 hover:bg-neutral-100">${name}</a>`)
            .click(function(event) {
                event.preventDefault();
                let clickedUrl = $(this).attr('data-url');
                let clickedNextPart = $(this).attr('data-next');
                loadSegments(clickedUrl, clickedNextPart);
                $(this).nextAll().remove();
            });

        breadcrumbs.append('<li class="text-neutral-500">/</li>');
        breadcrumbs.append(breadcrumbItem);
    }

    function returnToSegments() {
        loadSegments('/segment', 'family');
        $('#breadcrumbs').children('li:not(:first)').remove();
    }

    function addCommodity(name) {
        if (!addedCommodities.has(name)) {
            addedCommodities.add(name);
            let commodityList = $('#commodity-list');
            let commodityItems = $('#commodity-items');

            if (commodityList.hasClass('hidden')) {
                commodityList.removeClass('hidden');
            }

            let checkboxId = `checkbox-${name.replace(/\s+/g, '-').toLowerCase()}`;

            let commodityItem = $(`
                                        <li>
                                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input id="${checkboxId}" type="checkbox" value="${name}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="${checkboxId}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${name}</label>
                                            </div>
                                        </li>
            `);

            commodityItems.append(commodityItem);
        }
    }

    function deleteCheckedCommodities() {
        $('#commodity-items input:checked').each(function() {
            let value = $(this).val();
            addedCommodities.delete(value);
            $(this).closest('div').remove();
        });

        if ($('#commodity-items').children().length === 0) {
            $('#commodity-list').addClass('hidden');
        }
    }

    function checkAllCommodities(checked) {
        $('#commodity-items input[type="checkbox"]').each(function() {
            $(this).prop('checked', checked);
        });
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

                $.each(data.result.records, function(index, item) {
                    let regionName = item.regadm;
                    if (searchQuery === "" || regex.test(regionName)) {
                        let checkboxId = 'region-' + regionName.replace(/\s+/g, '-').toLowerCase();

                        let regionItem = $(`
                                        <li>
                                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input id="${checkboxId}" type="checkbox" value="${regionName}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="${checkboxId}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${regionName}</label>
                                            </div>
                                        </li>
                        `);

                        if (checkedRegions[checkboxId]) {
                            regionItem.find('input').prop('checked', true);
                        }

                        regionItem.find('input').change(function() {
                            checkedRegions[this.id] = $(this).is(':checked');
                            filterCities();
                        });

                        regionList.append(regionItem);
                    }
                });

                filterCities();
            },
            error: function() {
                alert('Failed to fetch regions.');
            }
        });
    }


    function loadCities(region, callback) {
        $.ajax({
            url: '/ville/' + encodeURIComponent(region),
            method: 'GET',
            success: function(data) {
                callback(data);
            },
            error: function() {
                alert('Failed to fetch cities for region: ' + region);
            }
        });
    }

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
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

            selectedRegions.forEach(region => {
                loadCities(region, function(data) {
                    $.each(data.result.records, function(index, item) {
                        let cityName = item.munnom.toLowerCase();
                        if (!loadedCities.has(cityName)) {
                            if (searchQuery === "" || regex.test(cityName)) {
                                loadedCities.add(cityName);
                                let checkboxId = 'city-' + cityName.replace(/\s+/g, '-').toLowerCase();
                                let cityItem = $(`
                                        <li>
                                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input id="${checkboxId}" type="checkbox" value="${item.munnom}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="${checkboxId}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${item.munnom}</label>
                                            </div>
                                        </li>
                                `);

                                if (checkedCities[checkboxId]) {
                                    cityItem.find('input').prop('checked', true);
                                }

                                cityItem.find('input').change(function() {
                                    checkedCities[this.id] = $(this).is(':checked');
                                });
                                
                                cityList.append(cityItem);
                            }
                        }
                    });

                    remainingRegions--;
                    if (remainingRegions === 0) {
                        cityList.removeClass('hidden');
                    }
                });
            });
        } else {
            $.ajax({
                url: '/ville',
                method: 'GET',
                success: function(data) {
                    $.each(data.result.records, function(index, item) {
                        let cityName = item.munnom.toLowerCase();
                        if (searchQuery === "" || regex.test(cityName)) {
                            let checkboxId = 'city-' + cityName.replace(/\s+/g, '-').toLowerCase();
                            let cityItem = $(`
                                        <li>
                                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <input id="${checkboxId}" type="checkbox" value="${item.munnom}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="${checkboxId}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${item.munnom}</label>
                                            </div>
                                        </li>
                                `);

                            if (checkedCities[checkboxId]) {
                                cityItem.find('input').prop('checked', true);
                            }

                            cityItem.find('input').change(function() {
                                checkedCities[this.id] = $(this).is(':checked');
                            });
                            
                            cityList.append(cityItem);
                        }
                    });

                    if (data.result.records.length > 0) {
                        cityList.removeClass('hidden');
                    } else {
                        cityList.addClass('hidden');
                    }
                },
                error: function() {
                    alert('Failed to fetch all cities.');
                }
            });
        }
    }

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
                                            <input id="${ licence.id }" type="checkbox" value="${ licence.titre }" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="${ licence.id }" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${ licence.titre }</label>
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
                                            <input id="${licence.id}" type="checkbox" value="${licence.titre}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="${licence.id}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${licence.titre}</label>
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

    function filterFournisseurs() {
        //filteredFournisseurs = fournisseurs.filter(f => )
        fournisseurs.forEach(fournisseur => {
            fournisseurItem = $(`
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    ${fournisseur.nomEntreprise}
                </th>
                <td class="px-6 py-4">
                    ${fournisseur.ville}
                </td>
                <td class="px-6 py-4">
                    0/0
                </td>
                <td class="px-6 py-4">
                    0/${Object.keys(checkedLicences).length}
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

    const debouncedFilterCities = debounce(filterCities, 300);
    const debouncedLoadRegions = debounce(loadRegions, 300);
    const debouncedSearchCommodities = debounce(onInputCommodities, 300);
    const debouncedScrollComodities = debounce(handleScroll, 300);

    loadSegments('/segment', 'family');
    loadRegions();
    filterLicences();
    filterFournisseurs();

    $('#breadcrumbs').children('li:first').click(returnToSegments);
    $('#delete-checked').click(deleteCheckedCommodities);
    $('#check-all').change(function() {
        checkAllCommodities(this.checked);
    });

    $('#searchCity').on('input', debouncedFilterCities);
    $('#searchRegion').on('input', debouncedLoadRegions);
    $('#searchSegment').on('input', debouncedSearchCommodities);
    $('#segment-list').on('scroll', debouncedScrollComodities);
    $('#searchCategorie').on('input', filterLicences);
});
</script>