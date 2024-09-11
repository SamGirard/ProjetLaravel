<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
            <h1>Fiche de {{$fournisseur->courriel}}</h1>
            @if(isset($fournisseur))
                <p>{{$fournisseur->neq}}</p>
                <p>{{$fournisseur->courriel}}</p>
                <p>{{$fournisseur->nomEntreprise}}</p>
                <p>{{$fournisseur->num_rbq}}</p>
                <p>{{$fournisseur->numCivique}}</p>
            @else
                <p>aucun fournisseur</p>
            @endif

            <h1>Information RBQ</h1>
            @if($infosRbq)
                <p>Num License: {{ $infosRbq->numLicense }}</p>
                <p>NEQ Fournisseur: {{ $infosRbq->neqFournisseur }}</p>
                <p>Courriel Fournisseur: {{ $infosRbq->courrielFournisseur }}</p>
                <p>Statut: {{ $infosRbq->statut }}</p>
                <p>Type License: {{ $infosRbq->typeLicense }}</p>
                <p>Catégorie: {{ $infosRbq->Catégorie }}</p>
                <p>Code Sous Catégorie: {{ $infosRbq->codeSousCategorie }}</p>
                <p>Travaux Permis: {{ $infosRbq->travauxPermis }}</p>
            @else
                <p>Aucune information RBQ disponible pour ce fournisseur.</p>
            @endif

            <a href="{{ route('index') }}">Retour à la liste</a>
    </body>
</html>