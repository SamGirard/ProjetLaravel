<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .email-container {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #4CAF50;
            padding: 20px;
            text-align: center;
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            font-size: 16px;
            color: #333;
        }
        .email-body p {
            margin-bottom: 20px;
        }
        .email-footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="email-header">
            <h1>Bienvenue, {{$role}}!</h1>
        </div>
        <div class="email-body">
            <p>Salut <strong>{{$role}}</strong>,</p>
            <p>Vous êtes maintenant connecté à votre compte avec succès. Nous sommes heureux de vous avoir parmi nous !</p>
            <p>
                <a href="{{ route('parametre') }}" class="btn">Voir les paramètres</a>
            </p>
        </div>
        <div class="email-footer">
            <p>Merci d'utiliser notre service.</p>
            <p>&copy; 2024 Votre Entreprise</p>
        </div>
    </div>

</body>
</html>