@extends('app')
@section('content')

    @include('partials/barre_ajout')

    <!-- service offerts -->

    <div class="container mx-auto mt-6">
        <form action="{{ route('store_service') }}" method="post"
              class="bg-white shadow-md rounded px-6 pt-6 pb-8 mb-4">
            @csrf
            <div class="flex flex-row justify-between">

                <fieldset class="border border-solid border-gray-300 p-3 w-full mr-2">
                    <legend class="ml-4 text-sm font-medium text-gray-900">Produits et services offerts</legend>
                    <div class="mb-4">
                        <label for="services" class="block text-gray-700 text-sm font-bold mb-2">SERVICES</label>
                        <input required
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="email" name="email" type="email">
                    </div>

                    <div class="mb-4">
                        <label for="details" class="block text-gray-700 text-sm font-bold mb-2">Détails et
                            spécifications</label>
                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="details" name="details"></textarea>
                    </div>
                </fieldset>

                <!-- Licence RBQ -->

                <fieldset class="border border-solid border-gray-300 p-3 w-full">
                    <legend class="ml-4 text-sm font-medium text-gray-900">Licence RBQ</legend>
                    <div class="mb-4 flex">
                        <div>
                            <label for="rbq" class="block text-gray-700 text-sm font-bold mb-2">Licence RBQ</label>
                            <input required id="rbq" name="rbq" type="text"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <span class="text-red-500" id="erreur_rbq"></span>
                        </div>
                        <div class="ml-2">
                            <label for="statut_licence_rbq"
                                   class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                            <select id="statut_licence_rbq" name="statut_licence_rbq"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="type_licence_rbq"
                               class="block text-gray-700 text-sm font-bold mb-2">Type de licence</label>
                        <select id="type_licence_rbq" name="type_licence_rbq"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        </select>
                    </div>
                </fieldset>


            </div>

            <fieldset class="border border-solid border-gray-300 mt-4 p-3 w-full">
                <legend class="ml-4 text-sm font-medium text-gray-900">Catégories et sous-catégories autorisées</legend>
                <div class="mb-4">
                    <label for="categorie_generale"
                           class="block text-gray-700 text-sm font-bold mb-2">CATÉGORIE ENTREPRENEUR GÉNÉRAL</label>
                    <select multiple id="categorie_generale" name="categorie_generale[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($categorie_services as $categorie_service)
                            @if($categorie_service['type']=='Général')
                                <option value="{{ $categorie_service['id'] }}">{{ $categorie_service['code'] }} {{ $categorie_service['nom'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="categorie_specialise"
                           class="block text-gray-700 text-sm font-bold mb-2">CATÉGORIE ENTREPRENEUR SPÉCIALISÉ</label>
                    <select multiple id="categorie_specialise" name="categorie_specialise[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($categorie_services as $categorie_service)
                            @if($categorie_service['type']=='Spécialisé')
                                <option value="{{ $categorie_service['id'] }}">{{ $categorie_service['code'] }} {{ $categorie_service['nom'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

            </fieldset>

            <div class="flex justify-between mt-3">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    onclick="window.history.back();">
                    Précédent
                </button>
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Suivant
                </button>
            </div>
        </form>
    </div>

@endsection
@section('scripts')
    <script !src="">

        // Fonction pour vérifier et sélectionner une option dans un select
        function selectOptionIfExists(selectId, optionValue) {
            const selectElement = document.getElementById(selectId);
            let optionExists = false;

            // Parcourir toutes les options du select
            for (let i = 0; i < selectElement.options.length; i++) {

                if (selectElement.options[i].textContent.includes(optionValue)) {
                    selectElement.selectedIndex = i;  // Sélectionner l'option si elle existe
                    optionExists = true;
                    selectElement.dispatchEvent(new Event('change'));
                   // alert('9900-0895-49');

                    break;
                }
            }

            if (!optionExists) {
                console.log(`L'option avec la valeur "${optionValue}" n'existe pas dans le select.`);
            }
        }


        async function chagerToutesLesVilles() {

            try {
                const response = await fetch(`https://www.donneesquebec.ca/recherche/dataset/755b45d6-7aee-46df-a216-748a0191c79f/resource/5183fdd4-55b1-418c-8a7d-0a70058ed68d/download/rdl01_extractiondonneesouvertes.json`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                donnees = data['Liste Licence'];

            } catch (error) {
                console.error('Erreur lors du chargement des villes :', error);
            }
        }

        document.addEventListener('DOMContentLoaded', chagerToutesLesVilles);

        document.getElementById('rbq').addEventListener('change', function () {

            const regexRbq = /^\d{4}-\d{4}-\d{2}$/;

            if (regexRbq.test(this.value)) {
                let data;
                for (let i = 0; i < donnees.length; i++) {
                    let items = donnees[i].Licence;

                    for (let j in items) {
                        if (this.value == items[j]) {
                            data = items;
                            break;
                        }
                    }
                }
                if (data != null) {

                    // selectionner les categorie generales en fonction du rbq entré
                    for (let i=0; i<data['Catégories et sous-catégories'].length;i++){
                        console.log(data['Catégories et sous-catégories'][i]['Sous-catégories']);
                        selectOptionIfExists('categorie_generale',data['Catégories et sous-catégories'][i]['Sous-catégories']);
                    }
                    // retirer les message d'erreur de RBQ si valide
                    document.getElementById('erreur_rbq').textContent = "";
                    this.classList.remove('border-red-500');

                    let statut = data['Statut de la licence'];
                    let option_statut = document.createElement('option');
                    option_statut.value = statut;
                    option_statut.textContent = statut;
                    document.getElementById('statut_licence_rbq').innerHTML="";
                    document.getElementById('statut_licence_rbq').appendChild(option_statut);

                    let type_licence = data['Type de licence'];
                    let option_type_licence = document.createElement('option')
                    option_type_licence.value = type_licence;
                    option_type_licence.textContent = type_licence;

                    document.getElementById('type_licence_rbq').innerHTML="";
                    document.getElementById('type_licence_rbq').appendChild(option_type_licence);
                } else {
                    // ajouter les messages d'Erreur si rbq valide
                    document.getElementById('erreur_rbq').textContent = "licence RBQ inexistant!";
                    this.classList.add('border-red-500');
                }
            } else {
                document.getElementById('erreur_rbq').textContent = "format de donnée invalide!";
                this.classList.add('border-red-500');
            }
        });

        // Initialiser les options des select des categories
       const select_categorie_general = new TomSelect(document.getElementById('categorie_generale'), {
            create: false, // Empêcher la création de nouvelles options
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        const  select_categorie_specialise = new TomSelect(document.getElementById('categorie_specialise'), {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

    </script>
@endsection
