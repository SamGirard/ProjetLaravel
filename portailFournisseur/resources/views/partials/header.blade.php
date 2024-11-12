<header class="bg-blue-900 text-white shadow-lg">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        <!-- Section Titre -->
        <div class="flex items-center">
            <div class="bg-white h-20 w-20 flex items-center justify-center">
                <img src="https://www.v3r.net/wp-content/themes/v3r/Images/icons/logo-v3r-v2.svg" alt="Logo" class="h-16 w-16">
            </div>
            <span class="text-2xl font-bold tracking-wide ml-2">Trois-Rivières</span>
        </div>

        <!-- Section Logo avec Icône à droite -->
        @if(Auth::user())
            <div class="flex items-center">
                <form id="formDeconnexion" method="post" action="{{ route('logout') }}">
                    @csrf
                    <i class="fa-solid fa-right-from-bracket text-white mr-4 text-3xl cursor-pointer"
                       onclick="event.preventDefault(); document.getElementById('formDeconnexion').submit();"></i>
                </form>
            </div>
        @else
           <div>
               <a href="{{ route('login') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-md">Connexion</a>
               <a href="{{ route('create_identification') }}" class="bg-green-700 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md">Inscription</a>
           </div>
        @endif
    </div>
</header>
