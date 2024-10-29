<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
    <body>
        <h1>Test</h1>

        @if(count($fournisseurs))
            @foreach($fournisseurs as $fournisseur)
                <a href="{{ route('fournisseurs.show', $fournisseur->neq) }}">
                    <p>{{ $fournisseur->neq }}</p>
                </a>
            @endforeach
        @else
            <p>aucun fournisseur</p>
        @endif

        <a href="{{ route('role') }}">Gérer les droits</a>

        @vite('resources/js/app.js')
    </body>
</html>