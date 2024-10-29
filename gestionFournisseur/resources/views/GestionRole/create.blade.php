@extends('layouts.app')
    @section('title', "Ajouter un employés")
    
    @section('contenu')
        <div class="items-center h-screen flex justify-center">
            <form method="post" action="{{ route('employes.store') }}" class="px-8 pt-6 pb-8 mb-4">
                <h1 class="font-bold text-2xl mb-5">Ajouter un employé</h1>
                @csrf

                <label for="courriel" class="text-grey text-sm font-bold mb-2">Courriel</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100" name="courriel" id="courriel" type="email" placeholder="Courriel">
                @error('courriel')
                    <div class="mb-5 mt-2 text-red-500">{{ $message }}</div>
                @enderror

                <label for="role" class="text-grey text-sm font-bold mb-2">Rôle</label>
                <select name="role" id="role" class="block appearance-none w-full bg-white px-4 py-2 pr-8 border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100">
                    <option>Choisissez le rôle</option>
                    <option>Administrateur</option>
                    <option>Responsable</option>
                    <option>Commis</option>
                </select>
                @error('role')
                    <div class="mb-5 mt-2 text-red-500">{{ $message }}</div>
                @enderror

                <button type="submit" class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-4">
                    Ajouter 
                </button>
            
            </form>
        </div>
    @endsection
