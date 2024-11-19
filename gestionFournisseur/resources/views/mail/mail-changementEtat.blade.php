<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification de Changement d'État</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
        }
        .boutonFiche {
            background-color: rgb(0, 85, 255);
            padding: 15px;
            text-decoration: none;
            color: white;
            transition: 0.3s;
            border-radius: 10px;
        }
        .boutonFiche:hover{
            background-color: rgb(0, 72, 215);
            color: white;
        }
        .etat{
            font-weight: bold;
        }
        .footer{
            margin-top: 70vh;
            margin-bottom: 0px;
            text-align: center;
            background-color: rgb(225, 225, 225);
            color: rgb(170, 170, 170);
            padding: 40px;
        }
        .barre{
            width: 600px;
            height: 3px !important;
            border: none;
            border-radius: 15px;
            background-color: rgb(0, 65, 196);
            margin: auto;
        }
        .box h1{
            background-color: white;
            margin: 0px;
            padding: 25px 15px 10px 15px;
        }
        .box h4{
            background-color: white;
            margin: 0px;
            padding: 0px 15px 25px 15px;
        }
        @media (max-width: 600px) {
            h1 {
                font-size: 20px;
            }
            h4 {
                font-size: 16px;
            }
            .status {
                padding: 8px;
            }
            .footer {
                font-size: 12px;
            }
            .box h1{
                background-color: white;
                margin: 0px;
                padding: 25px 15px 10px 15px;
            }
            .box h4{
                background-color: white;
                margin: 0px;
                padding: 0px 15px 25px 15px;
            }
            .barre{
                width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row text-center mb-5 mt-5">
            <div class="col-md-2 col-sm-2">
                <img src="{{ asset('img/logoTr.png') }}" height="70px" width="70px" alt="">
            </div>
            <div class="col-md-4 offset-md-2">
                <h1>Ville de Trois-Rivières</h1>
            </div>
        </div>
        <div class="text-center">

            <div class="box text-center">
                <div class="row">
                    <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-xs-4 offset-xs-2">
                        <h1>Bonjour, {{$email}}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-xs-4 offset-xs-2">
                        <h4 class="mb-4">Votre demande a été mise à jour</h4>
                    </div>
                </div>
            </div>

            <hr class="mb-4 barre">
            <div class="status">
                <p class="message mb-5">Votre dossier à été mis à jour! Votre demande d'admission est maintenant <span class="etat">{{$etatDemande}}</span>. Vous pouvez consulter, modifier ou supprimer votre profil en cliquant sur le lien ci-dessous.</p>
            </div>
            <a class="boutonFiche mt-5" href="{{ route('pageCommis.fiche', ['fournisseur' => $id]) }}">Accèder à votre fiche</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }}, Ivan Landry Pombo Chedjou, Jérémy Thibault et Samuel Girard. Tous droits réservés.
        </div>
    </div>
</body>
</html>