<?php

namespace App\Http\Controllers;

use App\Mail\DemandeFournisseur;
use App\Models\Brochure;
use App\Models\CategorieService;
use App\Models\Contact;
use App\Models\Coordonnee;
use App\Models\DonneesServices;
use App\Models\Licence;
use App\Models\Parametre;
use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class FournisseurController extends Controller
{
    public function index()
    {
        // Récupérer tous les fournisseurs
        $fournisseurs = Fournisseur::all();

        // Passer les données à la vue
        return view('pageTest.test', compact('fournisseurs'));
    }

    public function show(Fournisseur $fournisseur)
    {
        $infosRbq = $fournisseur->infosRbq;
        return view('pageTest.show', compact('fournisseur', 'infosRbq'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_identification()
    {
        return view('fournisseur/form_identification');
    }

    public function store_identification(Request $request)
    {
        $validated = $request->validate([
            'neq' => ['nullable', 'size:10', 'regex:/^(11|22|33|88)[4-9]\d{7}$/', 'unique:' . User::class],
            'nom' => ['required', 'max:64'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:64', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:7', 'max:12', Rules\Password::defaults()],
        ]);

        $request->session()->put('form_identification', $request->all());
        //if($request->input('neq')!=null)
        return redirect()->route('create_service', ['neq' => $request->input('neq')]);
    }

    public function create_service(Request $request)
    {
        if ($request->session()->has('form_identification')) {
            $categorie_services = Licence::all();

            return view('fournisseur/form_produit_service', compact('categorie_services'));
        } else
            return redirect()->route('create_identification');
    }

    public function chercherService()
    {
        $valeur = \request('value');
        $listServices = array();
        $listCheminServices = ['app/public/services/Approvisionnement.csv', 'app/public/services/Autres.csv', 'app/public/services/Construction.csv', 'app/public/services/Services.csv'];

        for ($k = 0; $k < count($listCheminServices); $k++) {
            $data = $this->formaterDonneesServices($listCheminServices[$k]);
            for ($i = 1; $i < count($data); $i++) {
                for ($j = 0; $j < count($data[$i]); $j++) {
                    if (str_contains($data[$i][$j], $valeur)) {
                        array_push($listServices, $data[$i]);
                    }
                }
            }
        }
        return $listServices;
    }

    protected function formaterDonneesServices($cheminFichier)
    {
        $data = $this->lireFichierCsv($cheminFichier);
        $donnes = array();
        foreach ($data as $row) {
            // Créer un tableau associatif pour chaque ligne
            array_push($donnes, $row);
        }
        $listServices = $donnes[1];
        return $listServices;
    }

    protected function lireFichierCsv($cheminFichier)
    {
        $fichier = storage_path($cheminFichier);
        // Vérification de l'existence et de la lisibilité du fichier
        if (!file_exists($fichier) || !is_readable($fichier)) {
            return response()->json(['error' => 'Le fichier n\'existe pas ou n\'est pas lisible.'], 404);
        }
        $data = [];
        // Ouverture du fichier en mode lecture
        if (($handle = fopen($fichier, 'r')) !== false) {
            // Lecture du fichier ligne par ligne
            while (($row = fgetcsv($handle, 1000, ";")) !== false) {
                // On détecte l'encodage actuel de chaque champ de la ligne
                $row = array_map(function ($field) {
                    // Détection de l'encodage initial
                    $encoding = mb_detect_encoding($field, ['UTF-8', 'ISO-8859-1', 'Windows-1252'], true);

                    // Conversion en UTF-8 si nécessaire
                    if ($encoding !== 'UTF-8') {
                        return mb_convert_encoding($field, 'UTF-8', $encoding);
                    }
                    return $field; // Si déjà en UTF-8, ne pas convertir
                }, $row);

                // Ajouter la ligne convertie dans le tableau des données
                $data[] = $row;
            }
            // Fermeture du fichier après lecture
            fclose($handle);
        } else {
            return response()->json(['error' => 'Impossible d\'ouvrir le fichier.'], 500);
        }

        // Retourner les données sous forme de réponse JSON
        return response()->json($data);
    }

    public function store_service(Request $request)
    {
        // dd($request->all());
        $request->session()->put('form_service', $request->all());
        return redirect()->route('create_coordonnee');
    }

    public function create_coordonnee(Request $request)
    {
        $provinces = ['Québec', 'Ontario', 'Alberta', 'Manitoba', 'Saskatchewan', 'Colombie-Britannique', 'Nunavut', 'Territoire du Nort-Ouest', 'Yukon', 'Île-du-Prince-Édouard', 'Nouveau-Brunswick', 'Nouvelle-Écosse', 'Terre-Neuve-et-Labrador'];

        if ($request->session()->has('form_service') || auth::user())
            return view('fournisseur/form_coordonnee', compact('provinces'));
        else
            return redirect()->route('create_identification');

    }

    public function store_coordonnee(Request $request)
    {
        $validated = $request->validate([
            'numero_civique' => ['required', 'max_digits:8', 'numeric'],
            'rue' => ['required', 'max:64'],
            'bureau' => ['string', 'max:8'],
            'province' => ['required'],
            'ville' => ['required_if:province,Québec', 'max:64'],
            'region_administrative' => ['required_if:province,Québec'],
            'code_postal' => ['required', 'size:7', 'regex:/^(?!.*[DFIOQU])[A-VXY][0-9][A-Z] ?[0-9][A-Z][0-9]$/'],
            'site_internet' => ['nullable', 'max:64', 'url:http,https'],
            'type_telephone.0' => ['required'],
            'type_telephone.*' => ['nullable'],
            'telephone.0' => ['required', 'numeric', 'regex:/^(\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/'],
            'telephone.*' => ['nullable', 'numeric', 'distinct', 'regex:/^(\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/'],
            'poste.0' => ['nullable', 'max_digits:6', 'numeric'],
            'poste.*' => ['nullable', 'max_digits:6', 'numeric']

        ]);

        $request->session()->put('form_coordonnee', $request->all());

        return redirect()->route('create_contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_contact(Request $request)
    {

        $validated = $request->validate([
            'nom_contact' => ['required', 'max:32'],
            'prenom_contact' => ['required', 'max:32'],
            'fonction_contact' => ['required', 'max:32'],
            'email_contact' => ['required', 'string', 'lowercase', 'email', 'max:64'],
            'type_telephone_contact' => ['required'],
            'telephone_contact' => ['required', 'numeric', 'regex:/^(\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/'],
            'poste_contact' => ['nullable', 'max_digits:6', 'numeric'],
        ]);
        if (auth()->user()){
            $contact = new Contact();
            $contact->nom = $request->input('nom_contact');
            $contact->prenom = $request->input('prenom_contact');
            $contact->courriel = $request->input('email_contact');
            $contact->fonction = $request->input('fonction_contact');
            $contact->nom = $request->input('nom_contact');
            $contact->typeNumTelephone = $request->input('type_telephone_contact');
            $contact->numTelephone = $request->input('telephone_contact');
            $contact->poste = $request->input('poste_contact');
            $contact->fournisseur_id = auth()->user()->id;
            $contact->save();
            return redirect()->route('dashboard')->with(['ajouter_contact' => 'contact enregistré']);
        }else{

            $request->session()->put('form_contact', $request->all());
            return redirect()->route('create_brochure');
        }
    }

    public function create_contact(Request $request)
    {
        if ($request->session()->has('form_coordonnee'))
            return view('fournisseur./form_contact');
        else
            return redirect() > route('create_identification');
    }


    public function create_brochure(Request $request)
    {
        if ($request->session()->has('form_contact'))
            return view('fournisseur/form_brochure');
        else
            return redirect()->route('create_contact');
    }

    public function store_brochure(Request $request)
    {
        $request->validate([
            'files_brochure.*' => 'required|file|mimes:pdf,jpg,png,docx|max:' . Parametre::first()->tailleMaxFichiers
        ]);

        if ($request->hasFile('files_brochure')) {
            if (session()->has('form_identification') and session()->has('form_identification') and session()->get('form_service') and session()->get('form_contact')) {
                //dd(session()->all());
                $form_identification = session()->get('form_identification');
                $form_service = session()->get('form_service');
                $form_coordonne = session()->get('form_coordonnee');
                $form_contact = session()->get('form_contact');

                $user = new User();
                $user->nomEntreprise = $form_identification['nom'];
                $user->email = $form_identification['email'];
                $user->neq = $form_identification['neq'];
                $user->numeroTelephone = $form_coordonne['telephone'];
                $user->poste = $form_coordonne['poste'];
                $user->typeNumTelephone = $form_coordonne['type_telephone'];
                $user->password = Hash::make($form_identification['password']);


                $user->numCivique = $form_coordonne['numero_civique'];
                $user->rue = $form_coordonne['rue'];
                $user->bureau = $form_coordonne['bureau'];
                $user->codePostal = $form_coordonne['code_postal'];
                $user->ville = $form_coordonne['ville'];
                $user->regionAdministrative = $form_coordonne['region_administrative'];
                $user->code_administratif = $form_coordonne['code_administratif'];
                $user->siteInternet = $form_coordonne['site_internet'];

                $user->save();
                event(new Registered($user));

                $contact = new Contact();

                $contact->nom = $form_contact['nom_contact'];
                $contact->prenom = $form_contact['prenom_contact'];
                $contact->courriel = $form_contact['email_contact'];
                $contact->fonction = $form_contact['fonction_contact'];
                $contact->nom = $form_contact['nom_contact'];
                $contact->typeNumTelephone = $form_contact['type_telephone_contact'];
                $contact->numTelephone = $form_contact['telephone_contact'];
                $contact->poste = $form_contact['poste_contact'];
                $contact->fournisseur_id = $user->id;
                $contact->save();

                $service = new Service();
                $service->rbq = $form_service['rbq'];
                $service->type_licence = $form_service['type_licence_rbq'];
                $service->statut = $form_service['statut_licence_rbq'];
                $service->categorie_generale = $form_service['categorie_generale'];
                $service->categorie_specialise = $form_service['categorie_specialise'];
                $service->produit_services = $form_service['services'];
                $service->details = $form_service['details'];
                $service->fournisseur_id = $user->id;
                $service->save();

                foreach ($request->file('files_brochure') as $file) {
                    $path = $file->store('public/brochures');
                    $filename = basename($path);
                    $brochure = new Brochure();
                    $brochure->nom = $filename;
                    $brochure->type = $file->getClientOriginalName();
                    $brochure->fournisseur_id = $user->id;
                    $brochure->save();
                }
                Auth::login($user);

                Mail::to([$form_identification['email'], Parametre::first()->courrielAppro])->send(
                    new DemandeFournisseur(['nom' => $form_identification['nom'], 'message' => DB::table('modele_courriel')->select('message')->where('objet', 'reception')->first()->message])
                );

                session()->forget(['form_identification', 'form_identification', 'form_service', 'form_contact']);
                return redirect()->route('dashboard')->with('enregistrement_compte', 'Votre compte a bien été créé!');
            } else
                dd('aucune donnees');
        } else
            dd('aucun fichier');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }

}
