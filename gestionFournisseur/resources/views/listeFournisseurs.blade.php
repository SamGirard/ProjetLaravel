<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<div x-data="{ slideOverOpen: false }" class="relative z-50 w-auto h-auto">
    <button 
        @click="slideOverOpen = true" 
        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"
    >
        Filtrer
    </button>

        <div 
            x-show="slideOverOpen"
            @keydown.window.escape="slideOverOpen = false"
            class="relative z-[99]"
        >
            <div 
                x-show="slideOverOpen"
                x-transition.opacity.duration.600ms 
                @click="slideOverOpen = false" 
                class="fixed inset-0 bg-black bg-opacity-10"
            ></div>
            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
                        <div 
                            x-show="slideOverOpen" 
                            @click.away="slideOverOpen = false"
                            x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" 
                            x-transition:enter-start="translate-x-full" 
                            x-transition:enter-end="translate-x-0" 
                            x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" 
                            x-transition:leave-start="translate-x-0" 
                            x-transition:leave-end="translate-x-full" 
                            class="w-screen max-w-md"
                        >
                            <div class="flex flex-col h-full py-5 overflow-y-scroll bg-gray-50 dark:bg-gray-800 border-l shadow-lg border-neutral-100/70">
                                <div class="px-4 sm:px-5">
                                    <div class="flex items-start justify-between pb-1">
                                        <h2 class="text-base font-semibold leading-6 text-gray-900">Filtres</h2>
                                        <button 
                                            @click="slideOverOpen = false"
                                            class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-4 mr-5 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 text-neutral-600 hover:bg-neutral-100"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <span>Fermer</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="relative flex-1 px-4 mt-5 sm:px-5">
                                    <div class="absolute inset-0 px-4 sm:px-5">
                                        <div class="relative h-full overflow-hidden border border-dashed rounded-md border-neutral-300">
                                            <div x-data="{ activeAccordion: '', setActiveAccordion(id) { this.activeAccordion = this.activeAccordion === id ? '' : id } }" class="relative w-full mx-auto overflow-hidden text-sm font-normal bg-white border border-gray-200 divide-y divide-gray-200 rounded-md">
                                                <div x-data="{ id: $id('accordion') }">
                                                    <button 
                                                        @click="setActiveAccordion(id)" 
                                                        class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline"
                                                    >
                                                        <span>Produits et Services</span>
                                                        <svg 
                                                            class="w-4 h-4 duration-200 ease-out" 
                                                            :class="{ 'rotate-180': activeAccordion === id }" 
                                                            viewBox="0 0 24 24" 
                                                            xmlns="http://www.w3.org/2000/svg" 
                                                            fill="none" 
                                                            stroke="currentColor" 
                                                            stroke-width="2" 
                                                            stroke-linecap="round" 
                                                            stroke-linejoin="round"
                                                        >
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg>
                                                    </button>
                                                    <div x-show="activeAccordion === id" x-collapse x-cloak>
                                                        <div class="p-4 pt-0 opacity-70">
                                                            <div class="container mx-auto">
                                                                <nav class="flex justify-between">
                                                                    <ol id="breadcrumbs" class="inline-flex items-center mb-3 space-x-1 text-xs text-neutral-500 [&_.active-breadcrumb]:text-neutral-600 [&_.active-breadcrumb]:font-medium sm:mb-0">
                                                                        <li class="flex items-center h-full">
                                                                            <a class="inline-flex items-center px-2 py-1.5 space-x-1.5 rounded-md hover:text-neutral-900 hover:bg-neutral-100">
                                                                                <span class="hidden md:inline">Liste des produits et services</span>
                                                                                <span class="inline md:hidden">Liste</span>
                                                                            </a>
                                                                        </li>  
                                                                    </ol>
                                                                </nav>
                                                                <input 
                                                                    type="text" 
                                                                    placeholder="Rechercher un service..." 
                                                                    id="searchSegment"
                                                                    class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                                >
                                                                <div id="segment-list" class="h-64 overflow-y-scroll bg-white rounded shadow p-4"></div>
                                                                <div id="commodity-list" class="hidden h-64 overflow-y-scroll bg-white rounded shadow p-4 mt-4">
                                                                    <div id="commodity-items" class="space-y-2"></div>
                                                                    <button 
                                                                        id="delete-checked" 
                                                                        class="w-full mt-4 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                                                                    >
                                                                        Enlever du filtre
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div x-data="{ id: $id('accordion') }">
                                                    <button 
                                                        @click="setActiveAccordion(id)" 
                                                        class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline"
                                                    >
                                                        <span>Catégorie de travaux</span>
                                                        <svg 
                                                            class="w-4 h-4 duration-200 ease-out" 
                                                            :class="{ 'rotate-180': activeAccordion === id }" 
                                                            viewBox="0 0 24 24" 
                                                            xmlns="http://www.w3.org/2000/svg" 
                                                            fill="none" 
                                                            stroke="currentColor" 
                                                            stroke-width="2" 
                                                            stroke-linecap="round" 
                                                            stroke-linejoin="round"
                                                        >
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg>
                                                    </button>
                                                    <div x-show="activeAccordion === id" x-collapse x-cloak>
                                                    <div class="p-4 pt-0 opacity-70">
                                                            <input 
                                                                type="text" 
                                                                placeholder="Rechercher une catégorie..." 
                                                                id="searchCategorie"
                                                                class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                            >
                                                            <div id="categorie-list" class="h-64 overflow-y-scroll bg-white rounded shadow p-4">
                                                            @if(count($categoriesLicences))
                                                                @foreach($categoriesLicences as $categoriesLicence)
                                                                    <h1>{{ $categoriesLicence->titre }}</h1>
                                                                    
                                                                    @php
                                                                        $filteredLicences = $licences->where('Categorie', $categoriesLicence->id);
                                                                    @endphp
                                                                    
                                                                    @if(count($filteredLicences))
                                                                        @foreach($filteredLicences as $licence)
                                                                            <div class="flex items-center mb-4">
                                                                                <input id="{{ $licence->id }}" 
                                                                                    type="checkbox" 
                                                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900" 
                                                                                    value="{{ $licence->titre }}">
                                                                                <label for="{{ $licence->id }}" 
                                                                                    class="ml-2 text-sm font-medium text-gray-900">
                                                                                    {{ $licence->titre }}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div x-data="{ id: $id('accordion') }">
                                                    <button 
                                                        @click="setActiveAccordion(id)" 
                                                        class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline"
                                                    >
                                                        <span>Régions administratives</span>
                                                        <svg 
                                                            class="w-4 h-4 duration-200 ease-out" 
                                                            :class="{ 'rotate-180': activeAccordion === id }" 
                                                            viewBox="0 0 24 24" 
                                                            xmlns="http://www.w3.org/2000/svg" 
                                                            fill="none" 
                                                            stroke="currentColor" 
                                                            stroke-width="2" 
                                                            stroke-linecap="round" 
                                                            stroke-linejoin="round"
                                                        >
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg>
                                                    </button>
                                                    <div x-show="activeAccordion === id" x-collapse x-cloak>
                                                        <div class="p-4 pt-0 opacity-70">
                                                            <input 
                                                                type="text" 
                                                                placeholder="Rechercher une région..." 
                                                                id="searchRegion"
                                                                class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                            >
                                                            <div id="region-list" class="h-64 overflow-y-scroll bg-white rounded shadow p-4">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div x-data="{ id: $id('accordion') }">
                                                    <button 
                                                        @click="setActiveAccordion(id)" 
                                                        class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline"
                                                    >
                                                        <span>Villes</span>
                                                        <svg 
                                                            class="w-4 h-4 duration-200 ease-out" 
                                                            :class="{ 'rotate-180': activeAccordion === id }" 
                                                            viewBox="0 0 24 24" 
                                                            xmlns="http://www.w3.org/2000/svg" 
                                                            fill="none" 
                                                            stroke="currentColor" 
                                                            stroke-width="2" 
                                                            stroke-linecap="round" 
                                                            stroke-linejoin="round"
                                                        >
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg>
                                                    </button>
                                                    <div x-show="activeAccordion === id" x-collapse x-cloak>
                                                        <div class="p-4 pt-0 opacity-70">
                                                            <input 
                                                                type="text" 
                                                                placeholder="Rechercher une ville..." 
                                                                id="searchCity"
                                                                class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                            >
                                                            <div id="city-list" class="h-64 overflow-y-scroll bg-white rounded shadow p-4 mt-4">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

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
                <div class="flex items-center mb-4">
                    <input id="${checkboxId}" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900" value="${name}">
                    <label for="${checkboxId}" class="ml-2 text-sm font-medium text-gray-900">${name}</label>
                </div>
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
                            <div class="flex items-center mb-4">
                                <input id="${checkboxId}" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900" value="${regionName}">
                                <label for="${checkboxId}" class="ml-2 text-sm font-medium text-gray-900">${regionName}</label>
                            </div>
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
                                    <div class="flex items-center mb-4">
                                        <input id="${checkboxId}" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900" value="${item.munnom}">
                                        <label for="${checkboxId}" class="ml-2 text-sm font-medium text-gray-900">${item.munnom}</label>
                                    </div>
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
                                <div class="flex items-center mb-4">
                                    <input id="${checkboxId}" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900" value="${item.munnom}">
                                    <label for="${checkboxId}" class="ml-2 text-sm font-medium text-gray-900">${item.munnom}</label>
                                </div>
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
                $("#categorie-list").append(`<h1>${category.titre}</h1>`);

                let filteredLicences = licences.filter(licence => licence.Categorie === category.id);
                
                if (licences.length > 0) {
                    filteredLicences.forEach(licence => {
                        licenceItem = $(`
                            <div class="flex items-center mb-4">
                                <input id="${licence.id}" 
                                    type="checkbox" 
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900" 
                                    value="${licence.titre}">
                                <label for="${licence.id}" 
                                    class="ml-2 text-sm font-medium text-gray-900">
                                    ${licence.titre}
                                </label>
                            </div>
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
                        $("#categorie-list").append(`<h1>${category.titre}</h1>`);
                        filteredLicences.forEach(licence => {
                            licenceItem = $(`
                            <div class="flex items-center mb-4">
                                <input id="${licence.id}" 
                                    type="checkbox" 
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900" 
                                    value="${licence.titre}">
                                <label for="${licence.id}" 
                                    class="ml-2 text-sm font-medium text-gray-900">
                                    ${licence.titre}
                                </label>
                            </div>
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