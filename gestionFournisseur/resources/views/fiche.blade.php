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
    @foreach($demandes as $demande)
        <p>{{ $demande->etatDemande }}</p>
    @endforeach
    @foreach($infosRbq as $rbq)
        <p>{{ $rbq->travauxPermis }}</p>
    @endforeach
    @foreach ($infosUnspsc as $unspsc)
    <p>{{ $unspsc->name }}</p>
    @endforeach
@endif

@endsection