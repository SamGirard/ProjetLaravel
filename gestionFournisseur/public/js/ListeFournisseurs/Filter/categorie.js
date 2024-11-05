function loadCategorie(checkedLicences) {
    const categorieList = $('#categorie-list');
    const searchQuery = $('#searchCategorie').val().toLowerCase();
    const regex = new RegExp(searchQuery, 'i');
    $("#categorie-list").empty();

    let generalItems = [];
    const cachedGeneral = [...new Set(
        services
            .filter(service => filteredFournisseurs.some(f => f.id === service.fournisseur_id))
            .flatMap(service => JSON.parse(service.categorie_generale))
    )];

    cachedGeneral.forEach(general => {
        if (!searchQuery || regex.test(general)) {
            const isChecked = checkedLicences[general] ? 'checked' : '';

            generalItems.push(`
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="${general}" type="checkbox" value="${general}" ${isChecked} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="${general}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${general}</label>
                    </div>
                </li>
            `);
        }
    });

    if (generalItems.length > 0) {
        $("#categorie-list").append(`<h2 class="mb-2 text-base">Entrepreneur général</h2>`);
    }

    categorieList.append(generalItems.join(''));

    let specializeItems = [];
    const cachedSpecialize = [...new Set(
        services
            .filter(service => filteredFournisseurs.some(f => f.id === service.fournisseur_id))
            .flatMap(service => JSON.parse(service.categorie_specialise))
    )];

    cachedSpecialize.forEach(specialize => {
        if (!searchQuery || regex.test(specialize)) {
            const isChecked = checkedLicences[specialize] ? 'checked' : '';

            specializeItems.push(`
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="${specialize}" type="checkbox" value="${specialize}" ${isChecked} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="${specialize}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${specialize}</label>
                    </div>
                </li>
            `);
        }
    });

    if (specializeItems.length > 0) {
        $("#categorie-list").append(`<h2 class="mb-2 text-base">Entrepreneur spécialisé</h2>`);
    }

    categorieList.append(specializeItems.join(''));
}

window.loadCategorie = loadCategorie;