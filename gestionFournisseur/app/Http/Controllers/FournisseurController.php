<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\User;

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
    public function updateFournisseur(FournisseurRequest $request)
    {
        try{
            $fournisseur = User::first();

            $fournisseur->neq = $request->neq;
            $fournisseur->nomEntreprise = $request->nomEntreprise;
            $fournisseur->numeroTelephone = $request->numeroTelephone;
            $fournisseur->poste = $request->poste;
            $fournisseur->email = $request->email;
            $fournisseur->etatDemande = $request->etatDemande;
            $fournisseur->raisonRefus = $request->raisonRefus;
            $fournisseur->numTPS = $request->numTPS;
            $fournisseur->numTVQ = $request->numTVQ;
            $fournisseur->conditionPaiement = $request->conditionPaiement;
            $fournisseur->devise = $request->devise;
            $fournisseur->modeCommunication = $request->modeCommunication;
            $fournisseur->numCivique = $request->numCivique;
            $fournisseur->rue = $request->rue;
            $fournisseur->bureau = $request->bureau;
            $fournisseur->ville = $request->ville;
            $fournisseur->province = $request->province;
            $fournisseur->codePostal = $request->codePostal;
            $fournisseur->siteInternet = $request->siteInternet;
            $fournisseur->regionAdministrative = $request->regionAdministrative;
            $fournisseur->code_administratif = $request->code_administratif;
            
            $fournisseur->save();
                
            Mail::to($fournisseurs->email)->send(new MailModificationFournisseur($fournisseur->role, $fournisseur->etatDemande));

            return redirect()->route('pageCommis.liste')->with('success', 'Le fournisseurs est modifier!');
        }
        catch(\Throwable $e){
            return redirect()->route('pageCommis.liste')->withErrors('Erreur lors de la modification!');
        }
        return redirect()->route('pageCommis.liste');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyFournisseur(Request $request)
    {
        $fournisseur = new User($request->all());

        if ($request->has('fournisseurs')) {

            $user_details = User::where('neq', $neq)->first();
            $user_details->delete();

            Mail::to($fournisseurs->email)->send(new MailSuppressionFournisseur($fournisseur->email));
            return redirect()->route('pageCommis.liste')->with('success', 'Le fournisseurs est supprimer!');
        }
    }


    public function presentation(){
        return view('pagePresentation');
    }
}
