function loadUnspsc(checkedCommodities) {
    const segmentList = $('#segment-list');
    const searchQuery = $('#searchSegment').val().toLowerCase();
    const regex = new RegExp(searchQuery, 'i');
    let unspscItems = [];
    segmentList.empty();

    const cachedUnspsc = [...new Set(
        services
            .filter(service => filteredFournisseurs.some(f => f.id === service.fournisseur_id))
            .flatMap(service => JSON.parse(service.produit_services))
    )];

    cachedUnspsc.forEach(unspsc => {
        const name = unspsc.split('/')[3];

        if (!searchQuery || regex.test(name)) {
            const id = unspsc.split('/')[2];
            const isChecked = checkedCommodities[id] ? 'checked' : '';
            unspscItems.push(`
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="${id}" type="checkbox" value="${id}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" ${isChecked}>
                        <label for="${id}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">${name}</label>
                    </div>
                </li>
            `);
        }
    });

    segmentList.append(unspscItems.join(''));
}

window.loadUnspsc = loadUnspsc;
