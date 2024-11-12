@extends('app')

@section('content')
    @include('partials/header')

    <div class="container mx-auto mt-6 flex">

        <!-- Sidebar -->
        @include('partials/aside')

        <!-- Contenu principal -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6 ml-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-1 border-b-2 border-gray-300 pb-4">Ajouter les finances</h1>

            <div class="container mx-auto">
                <form action="{{ route('profil.store_finance') }}" method="post"
                      class="bg-white shadow-md rounded px-6 pt-6 pb-8 mb-4">
                    @csrf
                    <div class="mb-4 flex space-x-4">
                        <div class="flex-grow">
                            <label for="num_tps" class="block text-gray-600 text-sm font-bold mb-2">Numéro de
                                TPS</label>
                            <input required id="num_tps" name="num_tps" type="text"
                                   class="@error('num_tps') border-red-500 @else border-gray-300 @enderror shadow-sm border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('num_tps')
                            <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                            @enderror
                        </div>
                        @error('num_tps')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4 flex space-x-4">
                        <div class="flex-grow">
                            <label for="num_tvq" class="block text-gray-600 text-sm font-bold mb-2">Numéro de
                                TVQ</label>
                            <input required id="num_tvq" name="num_tvq" type="text"
                                   class="@error('num_vq') border-red-500 @else border-gray-300 @enderror shadow-sm border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('num_tvq')
                            <i class="fa-solid fa-circle-xmark ml-2 text-lg text-red-500 icon-validate"></i>
                            @enderror
                        </div>
                        @error('num_tvq')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="condition_paiement" class="block text-gray-600 text-sm font-bold mb-2">Conditions de
                            paiement</label>
                        <select id="condition_paiement" name="condition_paiement"
                                class="shadow-sm border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Selectionner une condition de paiement</option>
                            <option value="Payable immediatement sans déduction">Payable immediatement sans déduction</option>
                            <option value="Payable immediatement sans déduction,Date de base au 15 du mois suivant">Payable immediatement sans déduction,Date de base au 15 du mois suivant</option>
                            <option value="Dans les 15jours 2% escompte, dans les 30jours sans déduction">Dans les 15jours 2% escompte, dans les 30jours sans déduction</option>
                            <option value="après entre facture jusqu'au 15 du mois suivant 2% escompte">après entre facture jusqu'au 15 du mois suivant 2% escompte</option>
                            <option value="dans les 10 jours 2% escompte, dans les 30jours sans déduction">dans les 10 jours 2% escompte, dans les 30jours sans déduction</option>
                            <option value="dans les 15jours sans déduction">dans les 15jours sans déduction</option>
                            <option value="dans les 30jours sans déduction">dans les 30jours sans déduction</option>
                            <option value="dans les 45jours sans déduction">dans les 45jours sans déduction</option>
                            <option value="dans les 60jours sans déduction">dans les 60jours sans déduction</option>
                        </select>
                    </div>

                    <fieldset class="border border-gray-200 rounded-lg p-6">
                        <legend class="font-semibold text-gray-800 mb-4">Devise</legend>
                        <div class="flex items-center mb-4">
                            <input id="cad" type="radio" value="CAD-Dollar canadien" name="devise"
                                   class=" w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="cad" class="ms-2 block text-gray-600 text-sm font-bold">CAD-Dollar
                                canadien</label>
                        </div>
                        <div class="flex items-center">
                            <input checked id="usd" type="radio" value="USD-Dollar des États-unis" name="devise"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="usd" class="ms-2 block text-gray-600 text-sm font-bold">USD-Dollar des
                                États-unis</label>
                        </div>
                    </fieldset>

                    <fieldset class="border border-gray-200 rounded-lg p-6">
                        <legend class="font-semibold text-gray-800 mb-4">Mode de communication</legend>
                        <div class="flex items-center mb-4">
                            <input id="courriel" type="radio" value="courriel" name="mode_communication"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="courriel" class="ms-2 block text-gray-600 text-sm font-bold">Courriel</label>
                        </div>
                        <div class="flex items-center">
                            <input checked id="courrier_regulier" type="radio" value="courrier_regulier"
                                   name="mode_communication"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="courrier_regulier" class="ms-2 block text-gray-600 text-sm font-bold">Courrier
                                régulier</label>
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 transform hover:scale-105"
                            type="submit">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script !src="">

        const services = new TomSelect(document.getElementById('condition_paiement'), {
            create: true, // Empêcher la création de nouvelles options
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>
@endsection
