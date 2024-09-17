@extends('app')
@section('content')

    @include('partials/barre_ajout')
    <div class="container mx-auto mt-6">
        <form action="{{ route('store_coordonnee') }}" method="post" class="bg-white shadow-md rounded px-6 pt-6 pb-8 mb-4">
            @csrf

            <!--  ************* section adresse ******************** -->

            <fieldset class="border border-solid border-gray-300 p-3">
                <legend class="ml-4 text-sm font-medium text-gray-900">Adresse</legend>
                <div class="flex justify-start">
                    <div class="mb-4">
                        <label for="numero_civique" class="block text-gray-700 text-sm font-bold mb-2">Numero civique</label>
                        <div class="flex">
                            <input  class="@error('numero_civique')  border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="numero_civique" name="numero_civique" type="number">
                            @error('numero_civique')
                            <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                            @else
                                <i class="fa-solid fa-check text-lg ml-2 text-green-500 icon-validate"></i>
                            @enderror
                        </div>
                        @error('numero_civique')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4 mx-2">
                        <label for="rue" class="block text-gray-700 text-sm font-bold mb-2">Rue</label>
                        <div class="flex">
                            <input  class="@error('rue')  border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="rue" name="rue" type="text">
                            @error('rue')
                            <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                            @else
                                <i class="fa-solid fa-check text-lg ml-2 text-green-500 icon-validate"></i>
                                @enderror
                        </div>

                            @error('rue')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="mb-4 mx-2">
                        <label for="rue" class="block text-gray-700 text-sm font-bold mb-2">Bureau</label>
                        <input  class="@error('bureau')  border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="bureau" name="bureau" type="text">
                        @error('bureau')
                        <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 mx-2">
                    <label for="ville" class="block text-gray-700 text-sm font-bold mb-2">Ville</label>
                    <input  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ville" name="ville" type="text">
                </div>

                <div class="flex justify-start">
                    <div class="mb-4 mx-2">
                        <label for="rue" class="block text-gray-700 text-sm font-bold mb-2">Province</label>
                        <select name="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Quebec</option>
                        </select>
                    </div>
                    <div class="mb-4 mx-2">
                        <label for="code_postal" class="block text-gray-700 text-sm font-bold mb-2">Code postal</label>
                        <input  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="code_postal" name="code_postal" type="text">
                    </div>
                </div>

            </fieldset>

            <!-- section telephone -->

            <fieldset class="border border-solid border-gray-300 p-3 mt-2">
                <legend class="ml-4 text-sm font-medium text-gray-900">Téléphones</legend>
                <div class="mb-4">
                    <label for="telephone" class="block text-gray-700 text-sm font-bold mb-2"> telephone</label>
                    <input  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="motDePasse" name="telephone" type="tel">

                </div>
            </fieldset>

            <div class="flex justify-between mt-3">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="window.history.back();">
                    Précédent
                </button>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Suivant
                </button>
            </div>
        </form>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
