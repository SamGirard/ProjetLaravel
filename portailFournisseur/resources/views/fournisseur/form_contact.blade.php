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
        <div class="flex-1 bg-white rounded-lg p-6 ml-6">
            <form
                action="{{ auth()->check() &&  $contact!=null ? route('store_contact',$contact->id) : route('store_contact') }}"
                method="post"
                class="bg-white shadow-md rounded px-6 pt-6 pb-8 mb-4">
                @csrf
                @if(auth()->check() && $contact!=null)
                    @method('PUT')
                @endif
                <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">{{ auth()->check() && $contact!=null?'Modifier le ':'Ajouter' }}
                    contact</h1>
                <div class="grid grid-cols-2 gap-8">
                    <div class="border border-gray-200 rounded-lg p-6 bg-gray-50">
                        <div class="mb-4">
                            <label for="nom_contact" class="block text-lg text-gray-600 mb-2">Nom</label>
                            <div class="flex">
                                <input required
                                       class="@error('nom_contact')  border-red-500 @else border-gray-300 @enderror shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       id="nom_contact" name="nom_contact" type="text"
                                       value="{{ auth()->check() && $contact!=null ? $contact->nom : old('nom_contact') }}">
                                @error('nom_contact')
                                <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                @enderror

                            </div>
                            @error('nom_contact')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="prenom_contact" class="block text-lg text-gray-600 mb-2">Prenom</label>
                            <div class="flex">
                                <input required
                                       class="@error('prenom_contact')  border-red-500 @else border-gray-300 @enderror shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       id="prenom_contact" name="prenom_contact" type="text"
                                       value="{{ auth()->check()  && $contact!=null? $contact->prenom : old('prenom_contact') }}">
                                @error('prenom_contact')
                                <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                @enderror

                            </div>
                            @error('prenom_contact')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="fonction_contact" class="block text-lg text-gray-600 mb-2">Fonction</label>
                            <div class="flex">
                                <input required
                                       class="@error('fonction_contact')  border-red-500 @else border-gray-300 @enderror shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       id="fonction_contact" name="fonction_contact" type="text"
                                       value="{{ auth()->check() && $contact!=null ? $contact->fonction : old('fonction_contact') }}">
                                @error('fonction_contact')
                                <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                @enderror

                            </div>
                            @error('fonction_contact')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email_contact" class="block text-lg text-gray-600 mb-2">Adresse courriel</label>
                            <div class="flex">
                                <input required
                                       class="@error('email_contact')  border-red-500 @else border-gray-300 @enderror shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       id="email_contact" name="email_contact" type="email"
                                       value="{{auth()->check() && $contact!=null ? $contact->courriel : old('email_contact') }}">
                                @error('email_contact')
                                <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                @enderror

                            </div>
                            @error('fonction_contact')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="">
                        <div class="mb-4 flex justify-between border border-gray-200 rounded-lg p-6 bg-gray-50">
                            <div>
                                <label for='type_telephone_contact'
                                       class="block text-lg text-gray-600 mb-2">Type</label>
                                <select id="type_telephone_contact" name="type_telephone_contact"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option
                                        {{ auth()->check() && $contact!=null && $contact->typeNumTelephone=='Bureau'? 'selected':'' }} value="Bureau">
                                        Bureau
                                    </option>
                                    <option
                                        {{ auth()->check() && $contact!=null && $contact->typeNumTelephone=='Telecopieur'? 'selected':'' }} value="Telecopieur">
                                        Télécopieur
                                    </option>
                                    <option
                                        {{ auth()->check() && $contact!=null && $contact->typeNumTelephone=='Cellulaire'? 'selected':'' }} value="Cellulaire">
                                        Cellulaire
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="telephone_contact"
                                       class="block text-lg text-gray-600 mb-2">Telephone</label>
                                <div class="flex">
                                    <input
                                        value="{{ auth()->check() && $contact!=null ? $contact->numTelephone : old('telephone_contact') }}"
                                        class="@error('telephone_contact') border-red-500 @else border-gray-300 @enderror shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                        id="telephone_contact" name="telephone_contact" type="text"
                                        placeholder="8165668877">
                                    @error('telephone_contact')
                                    <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                                    @enderror
                                </div>
                                @error('telephone_contact')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="poste_contact" class="block text-lg text-gray-600 mb-2">Poste</label>
                                <div class="flex">
                                    <input
                                        value="{{ auth()->check() && $contact!=null? $contact->poste : old('poste_contact') }}"
                                        class="@error('poste_contact') border-red-500 @else border-gray-300 @enderror shadow-sm appearance-none border rounded-lg w-full py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
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
                        @if(auth()->check())
                            {{ $contact!=null? 'Modifier' : 'Ajouter'}}
                        @else
                            Suivant
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
    @include('partials/footer')
@endsection
