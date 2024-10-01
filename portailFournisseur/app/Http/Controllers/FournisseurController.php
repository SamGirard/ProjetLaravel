<?php

namespace App\Http\Controllers;

use App\Models\CategorieService;
use App\Models\User;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'password' => ['required', 'confirmed', 'min:7','max:12',Rules\Password::defaults()],
        ]);

        $request->session()->put('form_identification', $request->all());
        //if($request->input('neq')!=null)
        return redirect()->route('create_service',['neq'=>$request->input('neq')]);
    }

    public function create_service(Request $request)
    {

        if ($request->session()->has('form_identification')) {
            $categorie_services = CategorieService::all();

            return view('fournisseur/form_produit_service',compact('categorie_services'));
        } else
            return redirect()->route('create_identification');
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

        if($request->session()->has('form_service'))
            return view('fournisseur/form_coordonnee', compact('provinces'));
        else
            return redirect()->route('create_identification');

    }

    public function store_coordonnee(Request $request)
    {
        $validated = $request->validate([
            'numero_civique' => ['required', 'max_digits:8','numeric'],
            'rue' => ['required', 'max:64'],
            'bureau' => ['string', 'size:8'],
            'province' => ['required'],
            'ville' => ['required_if:province,Québec', 'max:64'],
            'region_administrative' =>['required_if:province,Québec'],
            'code_postal' => ['required', 'size:7', 'regex:/^(?!.*[DFIOQU])[A-VXY][0-9][A-Z] ?[0-9][A-Z][0-9]$/'],
            'site_internet' => ['nullable', 'max:64', 'url:http,https'],
            'type_telephone.0' => ['required'],
            'type_telephone.*' => ['nullable'],
            'telephone.0' => ['required','numeric','regex:/^(\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/'],
            'telephone.*' => ['nullable','numeric','distinct','regex:/^(\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/'],
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
            'telephone_contact' => ['required','numeric','regex:/^(\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/'],
            'poste_contact' => ['nullable', 'max_digits:6', 'numeric'],
        ]);
        $request->session()->put('form_contact', $request->all());

        dd($request->all());
    }

    public function create_contact(Request $request)
    {
        if($request->session()->has('form_coordonnee'))
            return view('fournisseur./form_contact');
        else
            return redirect()>route('create_identification');
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
