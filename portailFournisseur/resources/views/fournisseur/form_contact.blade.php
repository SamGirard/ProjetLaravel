@extends('app')
@section('content')

    @include('partials/barre_ajout')
    <div class="container mx-auto mt-6">
        <form action="{{ route('store_contact') }}" method="post"
              class="bg-white shadow-md rounded px-6 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="nom_contact" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                <div class="flex">
                    <input required
                           class="@error('nom_contact')  border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="nom_contact" name="nom_contact" type="text"  value="{{ old('nom_contact') }}">
                    @error('nom_contact')
                    <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                    @enderror

                </div>
                @error('nom_contact')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="prenom_contact" class="block text-gray-700 text-sm font-bold mb-2">Prenom</label>
                <div class="flex">
                    <input required
                           class="@error('prenom_contact')  border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="prenom_contact" name="prenom_contact" type="text"  value="{{ old('prenom_contact') }}">
                    @error('prenom_contact')
                    <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                    @enderror

                </div>
                @error('prenom_contact')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4">
                <label for="fonction_contact" class="block text-gray-700 text-sm font-bold mb-2">Fonction</label>
                <div class="flex">
                    <input required
                           class="@error('fonction_contact')  border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="fonction_contact" name="fonction_contact" type="text"  value="{{ old('fonction_contact') }}">
                    @error('fonction_contact')
                    <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                    @enderror

                </div>
                @error('fonction_contact')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email_contact" class="block text-gray-700 text-sm font-bold mb-2">Adresse courriel</label>
                <div class="flex">
                    <input required
                           class="@error('email_contact')  border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="email_contact" name="email_contact" type="email"  value="{{ old('email_contact') }}">
                    @error('email_contact')
                    <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                    @enderror

                </div>
                @error('fonction_contact')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4 flex justify-between" >
                <div>
                    <label for='type_telephone_contact' class="block text-gray-700 text-sm font-bold mb-2 mr-2">Type</label>
                    <select id="type_telephone_contact" name="type_telephone_contact"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Bureau">Bureau</option>
                        <option value="Telecopieur">Télécopieur</option>
                        <option value="Cellulaire">Cellulaire</option>
                    </select>
                </div>
                <div>
                    <label for="telephone_contact" class="block text-gray-700 text-sm font-bold mb-2">Telephone</label>
                    <div class="flex">
                        <input value="{{ old('telephone_contact') }}"
                               class="@error('telephone_contact') border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="telephone_contact" name="telephone_contact" type="text" placeholder="8165668877">
                        @error('telephone_contact')
                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                        @enderror
                    </div>
                    @error('telephone_contact')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="poste_contact" class="block text-gray-700 text-sm font-bold mb-2">Poste</label>
                    <div class="flex">
                        <input value="{{ old('poste_contact') }}"
                               class="@error('poste_contact') border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="poste_contact" name="poste_contact" type="text">
                        @error('poste_contact')
                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                        @enderror
                    </div>
                    @error('poste_contact')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

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
