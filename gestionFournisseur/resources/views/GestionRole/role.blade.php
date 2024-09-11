<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
    <body>
        <div class="bg-white py-24 sm:py-32">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            <div class="mx-auto grid max-w-3xl gap-x-8 gap-y-20 px-6 lg:px-8 xl:grid-cols-1">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Gérer les employés</h2>
                    <p class="mt-6 text-lg leading-8 text-gray-600">Ajouter, modifier les rôles ou supprimer les employés à partir de cette page.</p>
                </div>
                <ul role="list" class="grid gap-x-2 gap-y-2 sm:grid-cols-2 sm:gap-y-2 xl:col-span-2">
                @if(count($employes))
                    @foreach($employes as $employe)
                        <li class="border-solid border-2 border-blue-100 px-2 py-2 rounded-lg shadow-lg shadow-blue-100 bg-white">
                            <div class="flex items-center gap-x-6">
                            <div>
                                <h3 class="text-base font-semibold leading-7 text-lg tracking-tight text-gray-900">{{$employe->courriel}}</h3>
                                <select selected="{{$employe->role}}" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option value="Administrateur" {{ $employe->role == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
                                    <option value="Responsable" {{ $employe->role == 'Responsable' ? 'selected' : '' }}>Responsable</option>
                                    <option value="Commis" {{ $employe->role == 'Commis' ? 'selected' : '' }}>Commis</option>
                                </select>
                            </div>
                            </div>
                        </li>
                    @endforeach
                    @else
                        <p>aucun fournisseur</p>
                    @endif
                </ul>
                <div class="flex space-x-4">
                    <a class="bg-blue-600 px-4 py-2 rounded-lg text-white hover:bg-blue-500" href="">Enregistrer</a>
                    <a class="bg-blue-600 px-4 py-2 rounded-lg text-white hover:bg-blue-500" href="{{ route('employes.create')}}">Ajouter</a>
                    <a class="bg-blue-600 px-4 py-2 rounded-lg text-white hover:bg-blue-500" href="">Supprimer</a>
                </div>
            </div>
        </div>


        <div>
    </body>
</html>