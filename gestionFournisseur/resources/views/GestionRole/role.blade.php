<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <div>
            <h1>Gestion role</h1>
            
            @if(count($employes))
                @foreach($employes as $employe)
                <div>
                    <h2>{{ $employe->courriel }}</h2>
                    <select selected="{{$employe->role}}">
                        <option value="Administrateur" {{ $employe->role == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
                        <option value="Responsable" {{ $employe->role == 'Responsable' ? 'selected' : '' }}>Responsable</option>
                        <option value="Commis" {{ $employe->role == 'Commis' ? 'selected' : '' }}>Commis</option>
                    </select>
                </div>
                @endforeach
            @else
                <p>aucun fournisseur</p>
            @endif
            
            <br>
            <a href="{{ route('index') }}">Retour</a>
        </div>
    </body>
</html>