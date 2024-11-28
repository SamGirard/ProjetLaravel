<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Service;
use App\Http\Requests\UserRequest;
use App\Models\Brochure;
use Illuminate\Support\Facades\Log;


use Illuminate\Support\Facades\Mail;
use App\Mail\MailModificationFournisseur;
use App\Mail\MailChangementEtat;



class FournisseurController extends Controller
{
    public function index(){
        // Récupérer tous les fournisseurs
        $fournisseurs = User::all();

        // Passer les données à la vue
        return view('pageTest.test', compact('fournisseurs'));
    }

    public function show(User $fournisseur){
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
    public function updateFiche(UserRequest $request, User $fournisseur)
    {
        try{
            $etatInitial = $fournisseur->etatDemande;

            $fournisseur->neq = $request->neq;
            $fournisseur->nomEntreprise = $request->nomEntreprise;
            $fournisseur->typeNumTelephone = $request->typeNumTelephoneTest;
            $fournisseur->numeroTelephone = $request->numeroTelephoneTest;
            $fournisseur->poste = $request->posteTest;
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

            try{
                if ($request->hasFile('brochures')) {
                    // Supprimer toutes les brochures existantes liées au fournisseur
                    Brochure::where('fournisseur_id', $fournisseur->id)->delete();
                
                    // Réenregistrer les nouvelles brochures
                    foreach ($request->file('brochures') as $brochure) {
                        // Validation et stockage du fichier
                        $path = $brochure->store('brochures', 'public');
                        
                        // Création d'une nouvelle entrée dans la table brochures
                        Brochure::create([
                            'type' => $brochure->getClientOriginalExtension(),
                            'nom' => $brochure->getClientOriginalName(), 
                            'fournisseur_id' => $fournisseur->id, 
                        ]);
                    }
                }
            } catch(\Throwable $e){
                Log::debug($e);
            }
                
            Mail::to($fournisseur->email)->send(new MailModificationFournisseur($request->nomEntreprise, $request->etatDemande, $etatInitial, $fournisseur->id));

            if($etatInitial != $request->etatDemande){
                Mail::to($request->email)->send(new MailChangementEtat($request->etatDemande, $request->email, $fournisseur->id));
            }

            if($request->etatDemande != "Refusé"){
                $fournisseur->raisonRefus = "";
            } else {
                $fournisseur->raisonRefus = $request->raisonRefus;
                Brochure::where('fournisseur_id', $fournisseur->id)->delete();
            }

            $fournisseur->save();

            $contacts = json_decode($request->input('contacts'), true);
            $fournisseurId = $fournisseur->id;

            if ($contacts && $fournisseurId) {
                foreach ($contacts as $contactData) {
                    $existingContact = Contact::where('id', $contactData['id'])
                        ->where('fournisseur_id', $fournisseurId)
                        ->first();
        
                    if ($existingContact) {
                        $existingContact->delete();
                    }
        
                    Contact::create([
                        'prenom' => $contactData['prenom'],
                        'nom' => $contactData['nom'],
                        'fonction' => $contactData['fonction'],
                        'courriel' => $contactData['courriel'],
                        'typeNumTelephone' => $contactData['typeNumTelephone'],
                        'numTelephone' => $contactData['numTelephone'],
                        'poste' => $contactData['poste'] ?? null,
                        'fournisseur_id' => $fournisseurId,
                    ]);
                }
            }

            $services = Service::where('fournisseur_id', $fournisseurId)->first();

            if ($services) {
                $services->produit_services = $request->produit_services;
                $services->save();
            } else {
                return response()->json(['message' => 'Service not found'], 404);
            }

        } catch(\Throwable $e){
            Log::debug($e);
            return redirect()->route('pageCommis.liste');
        }

            return redirect()->route('pageCommis.liste')->with('success', 'Le fournisseurs est modifier!');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyFournisseur($id)
    {
        try{
            $fournisseur = User::findOrFail($id);
            Contact::where('fournisseur_id', $id)->delete();
            Service::where('fournisseur_id', $id)->delete();
            Brochure::where('fournisseur_id', $id)->delete();
            
            $fournisseur->delete();

            Mail::to($fournisseur->email)->send(new MailSuppressionFournisseur($fournisseur->nomEntreprise));
            return redirect()->route('pageCommis.liste')->with('success', 'Le fournisseurs est supprimer!');
        }
        catch(\Throwable $e){
            Log::debug($e);
            return redirect()->route('pageCommis.liste')->withErrors('Le fournisseurs n\'est pas supprimer!');
        }
        return redirect()->route('pageCommis.liste');
    }
}
