@extends('app')
@section('content')

    @include('partials/barre_ajout')

    <!-- service offerts -->

    <div class="container mx-auto mt-6">
        <form action="" method="post" class="bg-white shadow-md rounded px-6 pt-6 pb-8 mb-4">
            <div class="flex flex-row justify-between">


                <fieldset class="border border-solid border-gray-300 p-3 w-full mr-2">
                    <legend class="ml-4 text-sm font-medium text-gray-900">Produits et services offerts</legend>
                    <div class="mb-4">
                        <label for="services" class="block text-gray-700 text-sm font-bold mb-2">SERVICES</label>
                        <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email">
                    </div>

                    <div class="mb-4">
                        <label for="details" class="block text-gray-700 text-sm font-bold mb-2">Détails et spécifications</label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="details" name="details"></textarea>
                    </div>
                </fieldset>

                <!-- Licence RBQ -->

                <fieldset class="border border-solid border-gray-300 p-3 w-full">
                    <legend class="ml-4 text-sm font-medium text-gray-900">Licence RBQ</legend>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Adresse courriel</label>
                        <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email">
                    </div>
                </fieldset>

            </div>
        </form>
    </div>

@endsection
