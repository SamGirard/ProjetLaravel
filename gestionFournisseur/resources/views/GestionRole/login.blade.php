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

                <form method="POST" action="{{ route('loginPost') }}">
                @csrf
                    <h1 class="mb-3 font-bold text-xl">Connexion</h1>
                    <select name="courriel" id="roleSelect" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white focus:ring-blue-100">
                        <option value="none">Choisissez un compte</option>

                        @if(count($employes))
                            @foreach($employes as $employe)
                                <option value="{{ $employe->courriel }}" class="employe">{{$employe->courriel}}</option>
                            @endforeach
                        @endif
                    </select>
                    <button type="submit" class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-4">
                        Se connecter 
                    </button>
                </form>
            </form>
        </div>
    </body>
</html>