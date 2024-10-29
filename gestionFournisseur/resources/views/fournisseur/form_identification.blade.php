@extends('app')
@section('content')

    @include('partials/barre_ajout')
    <div class="container mx-auto mt-6">
        <form action="{{ route('store_indetification') }}" method="post" class="bg-white shadow-md rounded px-6 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="neq" class="block text-gray-700 text-sm font-bold mb-2">Numero d'entreprise du Québec (NEQ)</label>
                <div class="flex">
                    <input required class="@error('neq')  border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="neq" name="neq" type="text" placeholder="1164568745">
                    @error('neq')
                    <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                    @enderror
                    <!-- <i class="fa-solid fa-check text-lg ml-2 text-green-500 icon-validate"></i> -->
                </div>
            </div>

            <div class="mb-4">
                <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom de  l'entreprise</label>
                <div class="flex">
                    <input required class="@error('nom')  border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nom" name="nom" type="text">
                    @error('nom')
                    <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                    @enderror
                </div>
            </div>

            <!--  ************* section authentification ******************** -->

            <fieldset class="border border-solid border-gray-300 p-3">
                <legend class="ml-4 text-sm font-medium text-gray-900">Authentification</legend>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Adresse courriel</label>
                    <input  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email">
                </div>

                <div class="mb-4">
                    <label for="motDePasse" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
                    <input  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="motDePasse" name="motDePasse" type="password">

                </div>

                <div class="mb-4">
                    <label for="confirmerMotDePasse" class="block text-gray-700 text-sm font-bold mb-2">Confimrer le mot de passe</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="confirmerMotDePasse" name="confirmerMotDePasse" type="password">
                </div>

            </fieldset>
            <div class="flex justify-end mt-3">
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
