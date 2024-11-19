<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression de fiche</title>
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
                        <h1 class="mx-3">Suppression de fiche</h1>
                    </div>
                </div>
                <div class="row text-center pb-3">
                    <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                        <h4 class="mx-3">La fiche fournisseur de {{$nomEntreprise}} à été supprimé.</h4>
                    </div>
                </div>
            </div>
                <div class="row text-center mt-5">
                    <div class="col-md-6 offset-md-3">
                        <h2 class="titre2">Suppression confirmer</h2>
                    </div>
                </div>
                <div class="row text-center mt-2">
                    <div class="col-md-6 offset-md-3 col-sm-4 offset-sm-4 col-6 offset-3">
                        <p class="etat">La fiche est maintenant supprimer.</p>
                    </div>
                </div>

            <div class="footer">
                &copy; {{ date('Y') }}, Ivan Landry Pombo Chedjou, Jérémy Thibault et Samuel Girard. Tous droits réservés.
            </div>
        </div>
    </body>
</html>