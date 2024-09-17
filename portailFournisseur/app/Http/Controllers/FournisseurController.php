<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index(){
        // Récupérer tous les fournisseurs
        $fournisseurs = Fournisseur::all();

        // Passer les données à la vue
        return view('pageTest.test', compact('fournisseurs'));
    }

    public function show(Fournisseur $fournisseur){
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

    public function store_identification(Request $request){
        $validated = $request->validate([
            'neq' => ['required','size:10','regex:/^(11|22|33|88)[4-9]\d{7}$/','unique:'.User::class],
            'nom'=>'required|max:64',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:64', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->session()->put('form_identification',$request->all());
        session(['validation_identification' => 'ok']);
        return redirect()->route('create_service');
    }

    public function create_service(Request $request)
    {
        if($request->session()->has('form_identification')){

            //dd($request->session()->get('form_identification'));
            return view('fournisseur/form_produit_service');
        }
        else
            return redirect()->route('create_indentification');
    }

    public function store_service(Request $request)
    {
        return view('fournisseur/form_coordonnee');
    }
    public function create_coordonnee(Request $request)
    {

        return view('fournisseur/form_coordonnee');

    }
    public function store_coordonnee(Request $request)
    {
        $validated = $request->validate([
            'numero_civique' => ['required','max:8','alpha_num'],
            'rue'=>'required|max:64',
            'bureau' => ['string', 'lowercase', 'email', 'max:8'],
            'ville' => ['required','max:64'],
            'province'=>'required',
            'code_postal'=>['required','size:6','regex:/^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/'],
            'site_web'=>['max:64'],
            'type_telephone'=>'required',
            'numero'=>['required','regex:/^(\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/']
        ]);

       dd($request->all());
       // return redirect()->route('create_coordonnee');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
