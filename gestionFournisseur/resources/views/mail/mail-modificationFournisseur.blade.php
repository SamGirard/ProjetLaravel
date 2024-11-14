<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification de Changement d'État</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    .top{
        background-color: rgb(53, 114, 255);
        color: white;
    }
    .icon{
        width: 60px;
        height: 60px;
        background-color: rgba(0, 115, 255, 0.594);
        padding: 10px;
        border-radius: 50%;
        color: white;
    }xw
    .etat{
        font-size: 15pt;
    }
    span{
        font-weight: bold;
        font-size: 20pt;
    }
    .footer{
            margin-top: 70vh;
            margin-bottom: 0px;
            text-align: center;
            background-color: rgb(225, 225, 225);
            color: rgb(170, 170, 170);
            padding: 40px;
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
        .titre2 {
            color: white;
            font-size: 35pt;
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: rgb(92, 166, 255);
            font-family:Arial, Helvetica, sans-serif
        }
    @media (max-width: 800px) {
        .icon{
            width: 60px;
            height: 60px;
            background-color: rgba(0, 115, 255, 0.594);
            padding: 10px;
            border-radius: 50%;
            color: white;
        }
        .etat{
            font-size: 12pt;
        }
        span{
            font-weight: bold;
            font-size: 20pt;
        }
        .titre2{
            font-size: 25pt;
        }
    }
</style>
    <body>
        <div class="container-fluid p-0">
            <div class="top">
                <div class="row text-center pt-3">
                    <div class="col-md-8 offset-md-2">
                        <h1 class="mx-3">Modification d'état</h1>
                    </div>
                </div>
                <div class="row text-center pb-3">
                    <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                        <h4 class="mx-3">La fiche fournisseur de {{$nomEntreprise}} à été modifiée.</h4>
                    </div>
                </div>
            </div>
                <div class="row text-center mt-5">
                    <div class="col-md-6 offset-md-3">
                        <h2 class="titre2">Modification confirmer</h2>
                    </div>
                </div>
                <div class="row text-center mt-2">
                    <div class="col-md-6 offset-md-3">
                        <p class="etat">Vielle état de la demande: <span>{{$oldEtatDemande}}</span></p>
                    </div>
                </div>

                <div class="row text-center my-3">
                    <div class="col-md-6 offset-md-3">
                        <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1v12m0 0 4-4m-4 4L1 9"/>
                        </svg>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-md-6 offset-md-3">
                        <p class="etat">Nouvelle état de la demande : <span>{{$etatDemande}}</span></p>
                    </div>
                </div>

                <div class="row text-center mt-5">
                    <div class="col-md-6 offset-md-3">
                        <a class="boutonFiche" href="">Accèder au dossier</a>
                    </div>
                </div>

            <div class="footer">
                &copy; {{ date('Y') }}, Ivan Landry Pombo Chedjou, Jérémy Thibault et Samuel Girard. Tous droits réservés.
            </div>
        </div>
    </body>
</html>