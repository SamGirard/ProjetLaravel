<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Bonjour,</h1>
        <h4>La fiche de fournisseur de {{$nomEntreprise}} à été modifier</h4>
        <div class="status">
            État de la demande : {{$etatDemande}}
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Votre Entreprise. Tous droits réservés.
        </div>
    </div>
</body>
</html>