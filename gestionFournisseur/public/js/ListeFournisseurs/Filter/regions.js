function loadRegions(checkedRegions) {
    let searchQuery = $('#searchRegion').val().trim().toLowerCase();
    let regex = new RegExp(searchQuery, 'i');

    let regionList = $('#region-list');
    regionList.empty();
    let items = [];

    $.each(cachedRegions, function (index, region) {
        if (searchQuery === "" || regex.test(region)) {
            let isChecked = checkedRegions[region] ? 'checked' : '';

            items.push(`
            <li>
                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <input id="${region}" type="checkbox" value="${region}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" ${isChecked}>
                    <label for="${region}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${region}</label>
                </div>
            </li>
        `);
        }
    });

    regionList.append(items.join(''));
}

window.loadRegions = loadRegions;