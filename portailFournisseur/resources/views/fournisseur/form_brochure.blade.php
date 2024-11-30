@extends('app')
@section('content')
    @include('partials/header')
    @include('partials/barre_ajout')

    <div class="container mx-auto mt-6">
        <form action="{{ route('store_brochure') }}" method="post"
              class=" bg-white rounded-lg px-8 py-8 mb-6 transition-all duration-300 ease-in-out hover:shadow-2xl" enctype="multipart/form-data">
            @csrf
            <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">Brochures et cartes
                d'affairess</h1>
            <div class="grid grid-cols-2 gap-6">
                <!-- Brochures et cartes d'affaires-->
                <div class="">
                    <fieldset class="border border-gray-300 rounded-lg p-6 bg-gray-50">
                        <legend class="text-lg font-semibold text-gray-700 mb-4">Brochure et cartes d'affaires</legend>
                        <div class="mb-4">

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="files_brochure">Telecharger plusieures fichiers</label>
                            <input required name="files_brochure[]"
                                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                   id="files_brochure" type="file" multiple/>
                        </div>
                        <div id="liste_fichiers" class="mt-4"></div>
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Oups !</strong> Il y a eu quelques problèmes avec votre soumission :
                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </fieldset>
                </div>
            </div>

            <!-- Boutons -->
            <div class="mt-6 text-right">
                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105"
                    type="submit">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
    @include('partials/footer')
@endsection

@section('scripts')
    <script>
        let files_brochure = document.getElementById('files_brochure');
        let list_fichiers = document.getElementById('liste_fichiers');
        let taille_total = 0;
        let fileList = []; // Tableau pour stocker les fichiers sélectionnés

        files_brochure.addEventListener('change', () => {
            // Ajouter les fichiers sélectionnés dans le tableau `fileList`
            fileList = [...fileList, ...Array.from(files_brochure.files)];

            // Vider la liste actuelle avant de tout afficher
            list_fichiers.innerHTML = '';
            taille_total = 0; // Réinitialiser la taille totale

            // Parcourir la liste des fichiers sélectionnés
            fileList.forEach((file, i) => {
                const fileSize = (file.size / (1024 * 1024)).toFixed(2); // Taille en Mo, arrondi à 2 décimales

                // Créer un élément div pour chaque fichier
                const listItem = document.createElement('div');
                listItem.textContent = `${file.name} - ${fileSize} Mo`;

                // Créer l'icône de suppression
                const icon_supprime = document.createElement('i');
                icon_supprime.className = "fa-solid fa-xmark text-red-500 ml-3 cursor-pointer";
                icon_supprime.setAttribute('id', file.name + i);

                // Ajouter un événement pour supprimer l'élément de l'interface et de `fileList`
                icon_supprime.addEventListener('click', function () {
                    fileList.splice(i, 1); // Supprimer le fichier de la liste
                    displayFiles(); // Rafraîchir l'affichage

                });

                // Ajouter une classe pour le style
                listItem.className = 'py-1 border-b border-gray-300';
                listItem.appendChild(icon_supprime);
                list_fichiers.appendChild(listItem);

                // Calculer la taille totale
                taille_total += parseFloat(fileSize);
            });

            // Ajouter ou mettre à jour l'affichage de la taille totale
            updateTotalSize();
        });

        // Fonction pour rafraîchir l'affichage des fichiers
        function displayFiles() {
            list_fichiers.innerHTML = ''; // Réinitialiser la liste
            taille_total = 0;

            fileList.forEach((file, i) => {
                const fileSize = (file.size / (1024 * 1024)).toFixed(2);

                const listItem = document.createElement('div');
                listItem.textContent = `${file.name} - ${fileSize} Mo`;

                const icon_supprime = document.createElement('i');
                icon_supprime.className = "fa-solid fa-xmark text-red-500 ml-3 cursor-pointer";
                icon_supprime.setAttribute('id', file.name + i);

                icon_supprime.addEventListener('click', function () {
                    fileList.splice(i, 1); // Supprimer le fichier
                    displayFiles(); // Mettre à jour l'affichage
                });

                listItem.className = 'py-1 border-b border-gray-300';
                listItem.appendChild(icon_supprime);
                list_fichiers.appendChild(listItem);

                taille_total += parseFloat(fileSize);
            });

            updateTotalSize();
        }

        // Fonction pour mettre à jour la taille totale des fichiers
        function updateTotalSize() {
            let totalElement = document.getElementById('taille_totale');
            if (!totalElement) {
                totalElement = document.createElement('div');
                totalElement.setAttribute('id', 'taille_totale');
                totalElement.className = "font-semibold";
                list_fichiers.appendChild(totalElement);
            }
            totalElement.innerHTML = "Total : " + taille_total.toFixed(2) + " Mo";
        }
    </script>

@endsection
