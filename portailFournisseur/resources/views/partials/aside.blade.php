<aside class="w-64 bg-gradient-to-b from-blue-900 to-blue-700 shadow-2xl h-screen p-6 rounded-lg text-white">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Tableau de bord</h2>
        <i class="fa-solid fa-bars text-2xl"></i>
    </div>

    <nav>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-800 rounded-lg transition duration-300 ease-in-out">
                    <i class="fa-solid fa-user mr-3"></i> Ma fiche
                </a>
            </li>
            <li>
                <a href="{{ route('profil.create_parametre') }}" class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-800 rounded-lg transition duration-300 ease-in-out">
                    <i class="fa-solid fa-cog mr-3"></i> Paramètres
                </a>
            </li>
        </ul>
    </nav>
</aside>
