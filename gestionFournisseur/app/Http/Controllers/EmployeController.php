<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Employe;
use App\Http\Requests\EmployeRequest;
use App\Http\Requests\CourrielRequest;


use App\Models\CategoriesLicence;
use App\Models\Licence;

use App\Models\Fournisseur;
use App\Models\Demande;
use App\Models\InfosRbq;
use App\Models\Parametre;
use App\Models\Courriel;
use App\Models\RoleCourriel;


class EmployeController extends Controller
{
    public function index(){
        
    }

    public function create(){
        return view('GestionRole.create');
    }

    public function login()
    {
        request()->validate(['courriel' => 'required']);
        $user = Employe::where(['courriel' => request('courriel')])->first();

        if (!$user) {
            return redirect()->back()->withErrors(['courriel' => 'Employé introuvable']);
        }

        $employes = Employe::all();
        $categoriesLicences = CategoriesLicence::all();
        $licences = Licence::all();
        $fournisseurs = Fournisseur::all();
        $demandes = Demande::all();
        $infosRbq = InfosRbq::all();

        Auth::login($user);
        session()->regenerate();    

        // Rediriger l'utilisateur vers la bonne vue selon son rôle
        // Rediriger l'utilisateur selon son rôle
        if ($user->role == "Administrateur") {
            return redirect()->route('role');
        } elseif ($user->role == "Responsable" || $user->role == "Commis") {
            return redirect()->route('liste');
        }

        return redirect()->back()->withErrors(['role' => 'Accès refusé']);
    }

    public function showLoginForm(Request $request)
    {
        $employes = Employe::all();

        return View('GestionRole.login', compact('employes'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('loginEmploye');
    }

    public function store(EmployeRequest $request){
        try{
            $employe = new Employe($request->all());
            $employe->save();
        }
        catch(\Throwable $e){
            Log::debug($e);
        }
        return redirect()->route('role')->with('success', 'Employé ajouté avec succès!');
    }



    public function update(Request $request){
        $employe = new Employe($request->all());

        foreach($request->input('employes') as $employe){
            \App\Models\Employe::where('courriel', $employe['courriel'])->update([
                'role' => $employe['role'],
            ]);
        }
        return redirect()->back()->with('success', 'Les employés sont modifiés.');
    }



    public function destroy(Request $request){
        $employe = new Employe($request->all());

        if ($request->has('employe')) {
            // Boucler sur chaque employé (par courriel) et les supprimer
            foreach ($request->input('employe') as $courriel) {
                $employe_details = Employe::where('courriel', $courriel)->first();
                if ($employe_details) {
                    $employe_details->delete();
                }
            }
        }
    
        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Les employés sélectionnés ont été supprimés.');
        }


        public function afficherRole(){
            $employes = Employe::all();

            return view('GestionRole.role', compact('employes'));
        }

        public function afficherModeleCourriel(){
            $courriels = Courriel::all();

            return view('optionAdmin/modeleCourriel', compact('courriels'));
        }

        public function afficherParametre(){
            $parametres = Parametre::all();

            return view('optionAdmin/parametres', compact('parametres'));
        }

        public function storeCourrielRole(Request $request){
            try{
                $roleCourriel = new RoleCourriel($request->all());
                $roleCourriel->save();
            }
            catch(\Throwable $e){
                Log::debug($e);
            }
            return redirect()->route('modeleCourriel')->with('success', 'Role ajouté avec succès!');
        }

        public function updateCourriel(CourrielRequest $request, Courriel $courriel){
            try{
                $courriel->objet = $request->objet;
                $courriel->message = $request->message;
                $courriel->role = $request->role;
    
                $courriel->save();
                return redirect()->route('modeleCourriel')->with('message', 'Le modèle de courriel est modifier!');
            }
            catch(\Throwable $e){
                Log::debug($e);
                return redirect()->route('modeleCourriel')->withErrors('Erreur lors de la modification!');
            }
            return redirect()->route('modeleCourriel');
        }
    }