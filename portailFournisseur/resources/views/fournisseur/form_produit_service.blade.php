@extends('app')
@section('content')
    @include('partials/header')
    @include('partials/barre_ajout')

    <!-- service offerts -->
    <div class="container mx-auto mt-6">
        <form action="{{ route('store_service') }}" method="post"
              class="bg-white shadow-lg rounded-lg px-8 py-8 mb-6 transition-all duration-300 ease-in-out hover:shadow-2xl">
            @csrf
            <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">Services et Licences</h1>
            <div class="grid grid-cols-2 gap-6">

                <!-- Produits et services offerts -->
                <fieldset class="border border-gray-300 rounded-lg p-6 bg-gray-50">
                    <legend class="text-lg font-semibold text-gray-700 mb-4">Produits et services offerts</legend>
                    <div class="mb-4">
                        <label for="services" class="block text-gray-600 text-sm font-bold mb-2">SERVICES</label>
                        <input required
                               class="shadow-sm border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
                               id="email" name="email" type="email">
                    </div>
                    <div class="mb-4">
                        <label for="details" class="block text-gray-600 text-sm font-bold mb-2">Détails et
                            spécifications</label>
                        <textarea
                                class="shadow-sm border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
                                id="details" name="details"></textarea>
                    </div>
                </fieldset>

                <!-- Licence RBQ -->
                <fieldset class="border border-gray-300 rounded-lg p-6 bg-gray-50">
                    <legend class="text-lg font-semibold text-gray-700 mb-4">Licence RBQ</legend>
                    <div class="mb-4 flex space-x-4">
                        <div class="flex-grow">
                            <label for="rbq" class="block text-gray-600 text-sm font-bold mb-2">Licence RBQ</label>
                            <input required id="rbq" name="rbq" type="text"
                                   class="shadow-sm border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <span class="text-red-500 text-sm" id="erreur_rbq"></span>
                        </div>
                        <div class="flex-grow">
                            <label for="statut_licence_rbq"
                                   class="block text-gray-600 text-sm font-bold mb-2">Statut</label>
                            <select id="statut_licence_rbq" name="statut_licence_rbq"
                                    class="shadow-sm border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400">
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="type_licence_rbq" class="block text-gray-600 text-sm font-bold mb-2">Type de
                            licence</label>
                        <select id="type_licence_rbq" name="type_licence_rbq"
                                class="shadow-sm border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </select>
                    </div>
                </fieldset>
            </div>

            <!-- Catégories et sous-catégories autorisées -->
            <fieldset class="border border-gray-300 rounded-lg mt-6 p-6 bg-gray-50">
                <legend class="text-lg font-semibold text-gray-700 mb-4">Catégories et sous-catégories autorisées
                </legend>
                <div class="mb-4">
                    <label for="categorie_generale" class="block text-gray-600 text-sm font-bold mb-2">CATÉGORIE
                        ENTREPRENEUR GÉNÉRAL</label>
                    <select multiple id="categorie_generale" name="categorie_generale[]"
                            class="shadow-sm border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @foreach($categorie_services as $categorie_service)
                            @if($categorie_service['type'] == 'Général')
                                <option value="{{ $categorie_service['id'] }}">{{ $categorie_service['code'] }} {{ $categorie_service['nom'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="categorie_specialise" class="block text-gray-600 text-sm font-bold mb-2">CATÉGORIE
                        ENTREPRENEUR SPÉCIALISÉ</label>
                    <select multiple id="categorie_specialise" name="categorie_specialise[]"
                            class="shadow-sm border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @foreach($categorie_services as $categorie_service)
                            @if($categorie_service['type'] == 'Spécialisé')
                                <option value="{{ $categorie_service['id'] }}">{{ $categorie_service['code'] }} {{ $categorie_service['nom'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </fieldset>

            <!-- Boutons -->
            <div class="flex justify-between mt-6">
                <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105"
                        onclick="window.history.back();">
                    Précédent
                </button>
                <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105"
                        type="submit">
                    Suivant
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script !src="">

        let neq = null;

        // Initialiser les options des select des categories
        const select_categorie_general = new TomSelect(document.getElementById('categorie_generale'), {
            create: false, // Empêcher la création de nouvelles options
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        const select_categorie_specialise = new TomSelect(document.getElementById('categorie_specialise'), {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        function extraireAvantEspace(chaine) {
            const index = chaine.indexOf(' '); // Trouve l'index du premier espace
            if (index !== -1) {
                return chaine.substring(0, index); // Retourne tout ce qui se trouve avant le premier espace
            }
            return chaine; // Retourne la chaîne complète si aucun espace n'est trouvé
        }

        // Fonction pour vérifier et sélectionner une option dans un select
        function selectOptionIfExists(selectId, optionValue, tomSelect) {

            const selectElement = document.getElementById(selectId);
            let optionExists = false;
            let optionExsitantes = [];
            // Parcourir toutes les options du select
            for (let i = 0; i < selectElement.options.length; i++) {
                if (extraireAvantEspace(selectElement.options[i].textContent.trim())===optionValue.trim()) {
                    optionExists = true;
                    optionExsitantes.push(i.toString());

                    // alert('9900-0895-49');
                }
            }

            for(let i=0;i<tomSelect.getValue().length;i++){
                optionExsitantes.push(tomSelect.getValue()[i]);
            }


            tomSelect.setValue(optionExsitantes);

            if (!optionExists) {
                console.log(`L'option avec la valeur "${optionValue}" n'existe pas dans le select.`);
            }
        }


        async function chagerLicences() {

            try {
                const response = await fetch(`https://www.donneesquebec.ca/recherche/dataset/755b45d6-7aee-46df-a216-748a0191c79f/resource/5183fdd4-55b1-418c-8a7d-0a70058ed68d/download/rdl01_extractiondonneesouvertes.json`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                donnees = data['Liste Licence'];

                // recherhe des donnees et du rbq si le NEQ est fourni
                if (window.location.pathname.split('/').pop() != null) {
                    neq = window.location.pathname.split('/').pop();

                    for (let i = 0; i < donnees.length; i++) {
                        let items = donnees[i].Licence;

                        for (let j in items) {
                            if (neq == items[j]) {

                                insererData(items);
                                console.log(items);
                                break;
                            }
                        }

                    }

                }

            } catch (error) {
                console.error('Erreur lors du chargement des licences :', error);
            }
        }

        document.addEventListener('DOMContentLoaded', chagerLicences);


        document.getElementById('rbq').addEventListener('change', function () {

            const regexRbq = /^\d{4}-\d{4}-\d{2}$/;

            // recherche des donnees fonction du rbq entré
            if (regexRbq.test(this.value)) {
                let dataNEQ;
                for (let i = 0; i < donnees.length; i++) {
                    let items = donnees[i].Licence;

                    for (let j in items) {
                        if (this.value == items[j]) {
                            dataNEQ = items;
                            console.log(dataNEQ);
                            break;
                        }
                    }
                }
                if (dataNEQ != null) {
                    insererData(dataNEQ);
                    this.classList.remove('border-red-500');
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

        // inserer les données du rbq dans les chams de formulaire
        function insererData(data) {

            if (neq != null) {
                document.getElementById('rbq').value = data['Numéro de licence'];
            }

            //vider les categorie si selectionné
            select_categorie_specialise.clear();
            select_categorie_general.clear();

            // selectionner les categorie generales en fonction du rbq entré
            for (let i = 0; i < data['Catégories et sous-catégories'].length; i++) {
                console.log(data['Catégories et sous-catégories'][i]['Categorie']);
                if (data['Catégories et sous-catégories'][i]['Categorie'] == "Specialisee")
                    selectOptionIfExists('categorie_specialise', data['Catégories et sous-catégories'][i]['Sous-catégories'], select_categorie_specialise);
                else if (data['Catégories et sous-catégories'][i]['Categorie'] == "Generale")
                    selectOptionIfExists('categorie_generale', data['Catégories et sous-catégories'][i]['Sous-catégories'], select_categorie_general);
            }
            // retirer les message d'erreur de RBQ si valide
            document.getElementById('erreur_rbq').textContent = "";

            let statut = data['Statut de la licence'];
            let option_statut = document.createElement('option');
            option_statut.value = statut;
            option_statut.textContent = statut;
            document.getElementById('statut_licence_rbq').innerHTML = "";
            document.getElementById('statut_licence_rbq').appendChild(option_statut);

            let type_licence = data['Type de licence'];
            let option_type_licence = document.createElement('option')
            option_type_licence.value = type_licence;
            option_type_licence.textContent = type_licence;

            document.getElementById('type_licence_rbq').innerHTML = "";
            document.getElementById('type_licence_rbq').appendChild(option_type_licence);
        }


    </script>
@endsection
