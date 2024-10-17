@extends('app')

@section('content')
    @include('partials/header')

    <div class="container mx-auto mt-6 flex">
        <!-- Sidebar -->
       @include('partials/aside')

        <!-- Contenu principal -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6 ml-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-4">Ma fiche fournisseur</h1>
            <div class="flex justify-between">
                <div>ssss</div>
                <div>dd</div>
                <div>ssss</div>
            </div>
        </div>
    </div>
@endsection
