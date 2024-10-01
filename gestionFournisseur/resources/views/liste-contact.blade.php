@extends('layouts.app')
@section('title', "Liste des fournisseurs")
@section('contenu')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<h1>Liste des Fournisseurs</h1>
<ul>
    @foreach($fournisseurs as $fournisseur)
        <li>
            {{ $fournisseur->nomEntreprise }} (NEQ : {{ $fournisseur->neq }})
            <ul>
                @foreach($contacts as $contact)
                    @if($contact->neqFournisseur == $fournisseur->neq)
                        <li>{{ $contact->nom }} (Email: {{ $contact->courriel }})</li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endforeach

</ul>

@endsection