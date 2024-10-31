@extends('layouts.app')
@section('title', "Liste des fournisseurs")
@section('contenu')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@if($fournisseur)
    <p>{{ $fournisseur->nomEntreprise }}</p>
    @foreach($contacts as $contact)
        <p>{{ $contact->prenom }}</p>
    @endforeach
@endif
<div class="flex">
    <form method="POST" action="{{route('updateFiche', [$fournisseur->id]) }}">
        @csrf
        @method('PATCH')

        @if($fournisseur)
            <select name="etatDemande">
                <option value="">État de la demande</option>
                <option value="Accepter">Accepter</option>
                <option value="Refusé">Refusé</option>
                <option value="En attente">En attente</option>
                <option value="À réviser">À réviser</option>

            </select>
        @endif
        <br>
        <button type="submit" class="mt-5">Enregistrer</button>
    </form>

    <div class="ml-4">
        @if($fournisseur)
            <p>État en cours : {{$fournisseur->etatDemande}}</p>
        @endif
    </div>
</div>

@endsection