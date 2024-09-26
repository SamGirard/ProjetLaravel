<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    @vite('resources/css/app.css')
</head>
    <body>
        <div class="items-center h-screen flex justify-center">
            <form method="POST" action="{{ route('loginEmploye') }}" class="px-8 pt-6 pb-8 mb-4">
                <h1 class="font-bold text-2xl mb-5">Connexion</h1>
                @csrf

                <label for="courriel" class="text-grey text-sm font-bold mb-3">Courriel</label>
                <input class="shadow appearance-none border rounded w-full mt-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100" name="courriel" id="courriel" type="email" placeholder="exemple@email.com">
                @error('courriel')
                    <div class="mb-5 mt-2 text-red-500">{{ $message }}</div>
                @enderror

                <button type="submit" class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-4">
                    Se connecter 
                </button>
            
            </form>
        </div>
    </body>
</html>