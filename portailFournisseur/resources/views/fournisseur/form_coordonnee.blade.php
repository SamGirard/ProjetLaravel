@extends('app')
@section('content')
    @include('partials/header')
    @if(!auth()->user())
        @include('partials/barre_ajout')
    @endif
    <div class="container flex mx-auto mt-6">
        @if(auth()->user())
            @include('partials/aside')
        @endif
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6 ml-6">
            <form action="{{ route('store_coordonnee') }}" method="post"
                  class="bg-white shadow-md rounded px-6 pt-6 pb-8 mb-4">
                @csrf
                @if(auth()->user())
                    @method('PUT')
                @endif
                <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">
                    @if(auth()->user())
                        Modifier les coordonnées
                    @else
                        Coordonnées
                    @endif
                </h1>
                <!--  ************* section adresse ******************** -->

                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <fieldset class="border border-gray-200 rounded-lg p-6 bg-gray-50">
                            <legend class="text-lg font-semibold text-gray-800 mb-4">Adresse</legend>

                            <div class="mb-4">
                                <label for="adresse_complete" class="block text-lg text-gray-600 mb-2">Adresse
                                    complète</label>
                                <input
                                    class="@error('adresse_complete') border-red-500 @enderror shadow appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    id="adresse_complete" name="adresse_complete" type="text"
                                    placeholder="Entrez l'adresse complète">
                            </div>

                            <div class="flex justify-start">
                                <div class="mb-4">
                                    <label for="numero_civique" class="block text-lg text-gray-600 mb-2">Numéro
                                        civique</label>
                                    <div class="flex">
                                        <input readonly
                                               value="{{ auth()->check() ? auth()->user()->numCivique : old('numero_civique') }}"
                                               class="@error('numero_civique') border-red-500 @enderror shadow appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
                                               id="numero_civique" name="numero_civique" type="text"
                                               placeholder="Numéro civique">
                                        @error('numero_civique')
                                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                        @enderror
                                    </div>
                                    @error('numero_civique')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 mx-2">
                                    <label for="rue" class="block text-lg text-gray-600 mb-2">Rue</label>
                                    <div class="flex">
                                        <input readonly value="{{ auth()->check() ? auth()->user()->rue : old('rue') }}"
                                               class="@error('rue') border-red-500 @enderror shadow appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
                                               id="rue" name="rue" type="text" placeholder="Nom de la rue">
                                        @error('rue')
                                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                        @enderror
                                    </div>
                                    @error('rue')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 mx-2">
                                    <label for="bureau" class="block text-lg text-gray-600 mb-2">Bureau</label>
                                    <div class="flex">
                                        <input value="{{ auth()->check() ? auth()->user()->bureau : old('bureau') }}"
                                               class="@error('bureau') border-red-500 @enderror shadow appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
                                               id="bureau" name="bureau" type="text" placeholder="Bureau">
                                        @error('bureau')
                                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                        @enderror
                                    </div>
                                    @error('bureau')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 mx-2">
                                <label for="ville" class="block text-lg text-gray-600 mb-2">Ville</label>
                                <select id="ville" name="ville"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <!-- Options pour les villes ici -->
                                    <option value="" disabled selected>Choisissez une ville...</option>
                                </select>
                            </div>

                            <div class="flex justify-start">
                                <div class="mb-4 mx-2">
                                    <label for="province" class="block text-lg text-gray-600 mb-2">Province</label>
                                    <select id="province" name="province"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @foreach($provinces as $province)
                                            <option
                                                value="{{ $province }}" {{(auth()->check() && auth()->user()->province == $province) ? 'selected' : '' }}>{{ $province }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4 mx-2">
                                    <label for="code_postal" class="block text-lg text-gray-600 mb-2">Code
                                        postal</label>
                                    <div class="flex">
                                        <input readonly
                                               value="{{ auth()->check() ? auth()->user()->codePostal : old('code_postal') }}"
                                               class="@error('code_postal') border-red-500 @enderror shadow appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
                                               id="code_postal" name="code_postal" type="text"
                                               placeholder="Code postal">
                                        @error('code_postal')
                                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                        @enderror
                                    </div>
                                    @error('code_postal')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-start">
                                <div class="mb-4 mx-2">
                                    <label for="region_administrative" class="block text-lg text-gray-600 mb-2">Région
                                        administrative</label>
                                    <div class="flex">
                                        <input
                                            value="{{ auth()->check() ? auth()->user()->regionAdministrative : old('region_administrative') }}"
                                            class="@error('region_administrative') border-red-500 @enderror shadow appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
                                            id="region_administrative" name="region_administrative" type="text"
                                            placeholder="Région administrative">
                                        @error('region_administrative')
                                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                        @enderror
                                    </div>
                                    @error('region_administrative')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4 mx-2">
                                    <label for="code_administratif" class="block text-lg text-gray-600 mb-2">Code
                                        administratif</label>
                                    <div class="flex">
                                        <input
                                            value="{{ auth()->check() ? auth()->user()->code_administratif : old('code_administratif') }}"
                                            class="@error('code_administratif') border-red-500 @enderror shadow appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
                                            id="code_administratif" name="code_administratif" type="text"
                                            placeholder="Code administratif">
                                        @error('code_administratif')
                                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                        @enderror
                                    </div>
                                    @error('code_administratif')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 mx-2">
                                <label for="site_internet" class="block text-lg text-gray-600 mb-2">Site
                                    internet</label>
                                <div class="flex">
                                    <input
                                        value="{{ auth()->check()? auth()->user()->siteInternet : old('site_internet') }}"
                                        class="@error('site_internet') border-red-500 @enderror shadow appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
                                        id="site_internet" name="site_internet" type="text"
                                        placeholder="Site internet">
                                    @error('site_internet')
                                    <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                    @enderror
                                </div>
                                @error('site_internet')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </fieldset>
                    </div>

                    <!-- section telephone -->

                    <div>
                        <fieldset class="border border-gray-200 rounded-lg p-6 bg-gray-50" id="section_telephone">

                            <!-- bouton pour ajouter un nouveau telephone -->
                            <div class="w-full my-2 flex justify-end" id="ajouter_telephone">
                                <i class="text-right fa-solid fa-plus bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer"></i>
                            </div>

                            <legend class="text-lg font-semibold text-gray-800 mb-4">Téléphones</legend>

                            <div class="mb-4 flex justify-between">
                                <div>
                                    <label for='type_telephone0' class="block text-lg text-gray-600 mb-2">Type</label>
                                    <select id="type_telephone0" name="type_telephone[]"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="Bureau">Bureau</option>
                                        <option value="Telecopieur">Télécopieur</option>
                                        <option value="Cellulaire">Cellulaire</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="telephone0" class="block text-lg text-gray-600 mb-2">Téléphone</label>
                                    <div class="flex">
                                        <input value="{{ old('telephone.0') }}"
                                               class="@error('telephone.0') border-red-500 @else border-gray-300 @enderror shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                               id="telephone0" name="telephone[]" type="text" placeholder="8165668877">
                                        @error('telephone.0')
                                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                        @enderror
                                    </div>
                                    @error('telephone.0')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="poste0" class="block text-lg text-gray-600 mb-2">Poste</label>
                                    <div class="flex">
                                        <input value="{{ old('poste.0') }}"
                                               class="@error('poste.0') border-red-500 @else border-gray-300 @enderror shadow appearance-none border rounded w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                               id="poste0" name="poste[]" type="text">
                                        @error('poste.0')
                                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                        @enderror
                                    </div>
                                    @error('poste.0')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            @foreach(old('telephone',[]) as $index => $value)
                                @if($index>0)
                                    <div class="mb-4 flex justify-between">
                                        <div>
                                            <label for='type_telephone{{$index}}'
                                                   class="block text-lg text-gray-600 mb-2">Type</label>
                                            <select id="type_telephone{{$index}}" name="type_telephone[]"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="Bureau">Bureau</option>
                                                <option value="Telecopieur">Télécopieur</option>
                                                <option value="Cellulaire">Cellulaire</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="telephone{{$index}}" class="block text-lg text-gray-600 mb-2">Téléphone</label>
                                            <div class="flex">
                                                <input value="{{ $value }}"
                                                       class="@error("telephone.$index") border-red-500 @else border-gray-300 @enderror shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                                       id="telephone{{$index}}" name="telephone[]" type="text"
                                                       placeholder="8165668877">
                                                @error("telephone.$index")
                                                <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                                @enderror
                                            </div>
                                            @error("telephone.$index")
                                            <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="poste{{$index}}"
                                                   class="block text-lg text-gray-600 mb-2">Poste</label>
                                            <div class="flex">
                                                <input value="{{ old('poste.'.$index) }}"
                                                       class="@error("poste.$index") border-red-500 @else border-gray-300 @enderror shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                                       id="poste{{$index}}" name="poste[]" type="text">
                                                @error("poste.$index")
                                                <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                                @enderror
                                            </div>
                                            @error("poste.$index")
                                            <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </fieldset>
                    </div>

                </div>

                <div class="@if(auth()->user()) text-right @else flex justify-between @endif mt-3">
                    @if(!auth()->user())
                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105"
                            onclick="window.history.back();">
                            Précédent
                        </button>
                    @endif
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105"
                        type="submit">
                        @if(auth()->user())
                            Enregistrer
                        @else
                            Suivant
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script>

        function initMap() {
            if (localStorage.getItem('coordonnesFournisseur') == null) {
                const center = {lat: 50.064192, lng: -130.605469};
                // Create a bounding box with sides ~10km away from the center point
                const defaultBounds = {
                    north: center.lat + 0.1,
                    south: center.lat - 0.1,
                    east: center.lng + 0.1,
                    west: center.lng - 0.1,
                };
                const input = document.getElementById('adresse_complete');
                const options = {
                    bounds: defaultBounds,
                    componentRestrictions: {country: "ca"},
                    fields: ['address_components', 'geometry', 'icon', 'name'],
                    strictBounds: false,
                };
                const autocomplete = new google.maps.places.Autocomplete(input, options);

                autocomplete.addListener('place_changed', function () {
                    const place = autocomplete.getPlace();

                    if (place.address_components) {
                        console.log(place.address_components);

                        for (const component of place.address_components) {
                            if (component.types.includes('postal_code')) {

                                document.getElementById('code_postal').value = component.long_name;
                            } else if (component.types.includes('street_number')) {
                                document.getElementById('numero_civique').value = component.long_name;
                            } else if (component.types.includes('route')) {
                                document.getElementById('rue').value = component.long_name;
                            } else if (component.types.includes('"administrative_area_level_3"')) {
                                console.log(component.long_name);
                                document.getElementById('ville').value = place.address_components[2].long_name;
                            } else if (component.types.includes('administrative_area_level_2')) {
                                document.getElementById('region_administrative').value = component.long_name;
                            }

                        }

                    }
                });
            } else {
                /*
                'code_region': items['Code de région administrative'],
                                'adresse': items['Adresse'],
                                'municipalite': items['Municipalité'],
                                'region_administrative': items['Région administrative']
                 */
                let coordonnesFournisseur = JSON.parse(localStorage.getItem('coordonnesFournisseur'));
                console.log(coordonnesFournisseur);
                localStorage.clear();
                document.getElementById('region_administrative').value = coordonnesFournisseur['region_administrative'];
                document.getElementById('code_administratif').value = coordonnesFournisseur['code_region'];
                document.getElementById('numero_civique').value = coordonnesFournisseur['adresse'].split(' ')[0];
                let code_postal = coordonnesFournisseur['adresse'].split(' ').slice(-2).join(' ');
                document.getElementById('code_postal').value = code_postal;
                let indexRue = coordonnesFournisseur['adresse'].indexOf('CANADA');
                let rue = coordonnesFournisseur['adresse'].slice(0, indexRue).trim();
                indexRue = rue.indexOf(' ');
                document.getElementById('rue').value = rue.slice(indexRue + 1).trim();

            }
        }

        let section_telephone = document.getElementById('section_telephone');
        let nb_telephone = 1;

        document.getElementById('ajouter_telephone').addEventListener('click', function () {
            nb_telephone++;
            let nouveau_telephone = `<div class="mb-4 flex justify-between">
            <div>
            <label for="type_telephone${nb_telephone}" class="block text-lg text-gray-600 mb-2">Type</label>
            <select name="type_telephone[]"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="Bureau">Bureau</option>
                <option value="Telecopieur">Télécopieur</option>
                <option value="Cellulaire">Cellulaire</option>
            </select>
        </div>
            <div>
                <label for="telephone" class="block text-lg text-gray-600 mb-2">Telephone</label>
                <input
                    class=" border-gray-300 shadow appearance-none border rounded w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    id="telephone${nb_telephone}" name="telephone[]" type="text">
            </div>
            <div>
                <label for="poste${nb_telephone}" class="block text-lg text-gray-600 mb-2">Poste</label>
                <input
                    class=" border-gray-300 shadow appearance-none border rounded w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    id="poste${nb_telephone}" name="poste[]" type="text">
            </div>
        </div>`;

            section_telephone.insertAdjacentHTML('beforeend', nouveau_telephone);
            console.log(section_telephone);
        });

        async function chagerToutesLesVilles(code_province) {

            try {
                const response = await fetch(`https://geogratis.gc.ca/services/geoname/en/geonames.json?province=${code_province}&concise=CITY`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();

                /* for(let i=0;i<data.items.length;i++){
                     console.log(data.items[i].name);
                 }*/

            } catch (error) {
                console.error('Erreur lors du chargement des villes :', error);
            }
        }


        // Fonction pour charger les options depuis le fichier CSV
        async function chargerVilles() {
            try {
                const response = await fetch('/storage/MUN.csv');

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.text(); // Récupérer le contenu du fichier CSV

                // Diviser le contenu par lignes
                const rows = data.split('\n');

                // Récupérer l'élément select pour la ville
                const selectElement = document.getElementById('ville');

                // Supposons que la ville de l'utilisateur connecté soit dans une variable `villeUtilisateur`
                const villeUtilisateur = @json(auth()->check() ? auth()->user()->ville : null);  // Récupérer la ville de l'utilisateur si connecté, sinon null

                // Ajouter les options au select
                for (let i = 1; i < rows.length; i++) {
                    const columns = rows[i].split(",");

                    if (columns[1]) {  // Vérifier si la colonne 2 existe (ville)
                        let option = document.createElement('option');
                        option.value = columns[1].trim(); // Retirer les espaces inutiles
                        option.textContent = columns[1].trim().slice(1, -1); // Supposer qu'il y a des guillemets à enlever

                        // Vérifier si c'est la ville de l'utilisateur
                        if (option.value === villeUtilisateur) {
                            option.selected = true;  // Pré-sélectionner l'option
                        }
                        selectElement.appendChild(option);
                    }
                }

                // Initialiser Tom Select une fois que les options sont ajoutées
                new TomSelect(selectElement, {
                    create: false, // Empêcher la création de nouvelles options
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

            } catch (error) {
                console.error('Erreur lors du chargement des villes :', error);
            }
        }


        // Charger les villes une fois que le DOM est prêt
        document.addEventListener('DOMContentLoaded', chargerVilles);

        chagerToutesLesVilles(24);

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8icF2VqlzWFDVUqm3iEcc7NixdSWnGx4&loading=async&libraries=places&callback=initMap">
    </script>
@endsection
