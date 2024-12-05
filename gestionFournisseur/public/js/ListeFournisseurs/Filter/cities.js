function filterCities(checkedCities, checkedRegions) {
    let cityItems = [];
    let searchQuery = $('#searchCity').val().trim().toLowerCase();
    let regex = new RegExp(searchQuery, 'i');
    let cityList = $('#city-list');

    console.log(regionCityList)
    console.log(checkedRegions)

    $.each(cachedCities, function (index, city) {
        if ((searchQuery === "" || regex.test(city)) && 
        (Object.values(checkedRegions).includes(true) === false || regionCityList.some(r => r.city === city && checkedRegions[r.region]))) {
            let isChecked = checkedCities["city-" + city] ? 'checked' : '';
            cityItems.push(`
            <li>
                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <input id="city-${city}" type="checkbox" value="${city}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" ${isChecked}>
                    <label for="city-${city}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${city}</label>
                </div>
            </li>
        `);
        }
    });

    cityList.empty();
    cityList.append(cityItems.join(''));
}

window.filterCities = filterCities;