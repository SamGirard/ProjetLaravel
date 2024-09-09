<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div x-data="{ slideOverOpen: false }" class="relative z-50 w-auto h-auto">
    <button 
        @click="slideOverOpen = true" 
        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"
    >
        Filtrer
    </button>

    <template x-teleport="body">
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
                            <div class="flex flex-col h-full py-5 overflow-y-scroll bg-white border-l shadow-lg border-neutral-100/70">
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
                                                                            <a href="#" class="inline-flex items-center px-2 py-1.5 space-x-1.5 rounded-md hover:text-neutral-900 hover:bg-neutral-100">
                                                                                <span class="hidden md:inline">Liste des produits et services</span>
                                                                                <span class="inline md:hidden">Liste</span>
                                                                            </a>
                                                                        </li>  
                                                                    </ol>
                                                                </nav>
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
                                                            Liste des catégories de travaux
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
                                                            <div id="region-list" class="h-64 overflow-y-scroll bg-white rounded shadow p-4">
                                                                    <!-- Regions will be dynamically inserted here -->
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
                                                            <div id="city-list" class="h-64 overflow-y-scroll bg-white rounded shadow p-4 mt-4">
                                                                <!-- Cities will be dynamically inserted here -->
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
    </template>
</div>

<script>
$(document).ready(function() {
    let addedCommodities = new Set();
    let selectedRegions = new Set();
    let currentCities = new Set();

    function loadSegments(url, nextUrlPart = null, breadcrumbName = null) {
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
            .html(`<a href="#" class="inline-flex items-center px-2 py-1.5 space-x-1.5 rounded-md hover:text-neutral-900 hover:bg-neutral-100">${name}</a>`)
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
        $.ajax({
            url: '/regions',
            method: 'GET',
            success: function(data) {
                let regionList = $('#region-list');
                regionList.empty();
                
                $.each(data.result.records, function(index, item) {
                    let regionName = item.regadm;
                    let checkboxId = 'region-' + regionName.replace(/\s+/g, '-').toLowerCase();
                    
                    let regionItem = $(`
                        <div class="flex items-center mb-4">
                            <input id="${checkboxId}" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900" value="${regionName}">
                            <label for="${checkboxId}" class="ml-2 text-sm font-medium text-gray-900">${regionName}</label>
                        </div>
                    `);
                    
                    regionItem.find('input').change(function() {
                        filterCities();
                    });
                    
                    regionList.append(regionItem);
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

    function filterCities() {
        let selectedRegions = $('#region-list input:checked').map(function() {
            return $(this).val();
        }).get();
        
        let cityList = $('#city-list');
        cityList.empty();

        if (selectedRegions.length > 0) {
            let loadedCities = new Set();
            let remainingRegions = selectedRegions.length;

            selectedRegions.forEach(region => {
                loadCities(region, function(data) {
                    $.each(data.result.records, function(index, item) {
                        let cityName = item.munnom;
                        if (!loadedCities.has(cityName)) {
                            loadedCities.add(cityName);
                            let checkboxId = 'city-' + cityName.replace(/\s+/g, '-').toLowerCase();
                            
                            let cityItem = $(`
                                <div class="flex items-center mb-4">
                                    <input id="${checkboxId}" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900" value="${cityName}">
                                    <label for="${checkboxId}" class="ml-2 text-sm font-medium text-gray-900">${cityName}</label>
                                </div>
                            `);
                            
                            cityList.append(cityItem);
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
                        let cityName = item.munnom;
                        let checkboxId = 'city-' + cityName.replace(/\s+/g, '-').toLowerCase();
                        
                        let cityItem = $(`
                            <div class="flex items-center mb-4">
                                <input id="${checkboxId}" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900" value="${cityName}">
                                <label for="${checkboxId}" class="ml-2 text-sm font-medium text-gray-900">${cityName}</label>
                            </div>
                        `);
                        
                        cityList.append(cityItem);
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

    loadSegments('/segment', 'family');
    loadRegions();

    $('#breadcrumbs').children('li:first').click(returnToSegments);
    $('#delete-checked').click(deleteCheckedCommodities);
    $('#check-all').change(function() {
        checkAllCommodities(this.checked);
    });
});

</script>
