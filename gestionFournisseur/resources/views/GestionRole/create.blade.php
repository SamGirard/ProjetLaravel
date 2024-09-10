<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
    <body>
        <div class="w-full max-w-sm">

            @if(isset($errors) && $errors->any())
                <div class="">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
        
            <form method="post" action="{{ route('employes.store') }}" class="px-8 pt-6 pb-8 mb-4">
            @csrf

                <label for="courriel" class="text-grey text-sm font-bold mb-2">Courriel</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="courriel" type="text" placeholder="Courriel">

                <label for="role" class="text-grey text-sm font-bold mb-2">Rôle</label>
                <select selected="{{ old('role') }}" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option>Administrateur</option>
                    <option>Responsable</option>
                    <option>Commis</option>
                </select>

                <button type="submit" class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-4">
                    Ajouter 
                </button>
            
            </form>
        </div>
    </body>
</html>