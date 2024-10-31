<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification de Changement d'État</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: auto;
            width: 100%; 
        }
        h1 {
            color: #007BFF; 
            text-align: center;
            font-size: 24px;
        }
        h4 {
            color: #333333; 
            text-align: center;
            font-size: 18px; 
        }
        .status {
            background-color: #007BFF;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
            width: 100%;
            justify-content: center;
        }
        .footer {
            text-align: center;
            color: #666666; 
            font-size: 14px;
            margin-top: 20px;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bonjour, {{$email}}</h1>
        <h4>Votre demande a été mise à jour :</h4>
        <div class="status">
            État de la demande : {{$etatDemande}}
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Votre Entreprise. Tous droits réservés.
        </div>
    </div>
</body>
</html>