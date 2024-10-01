<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Employe;
use App\Http\Requests\EmployeRequest;

use App\Models\CategoriesLicence;
use App\Models\Licence;

use App\Models\Fournisseur;
use App\Models\Demande;
use App\Models\InfosRbq;


class EmployeController extends Controller
{
    public function index(){
        $employes = Employe::all();

        if($employe->role == "Administrateur"){
            return view('GestionRole.role', compact('employes'));
            
        } else if ($employe->role == "Responsable" || $employe->role == "Commis"){
            return view('liste', compact('employes'));
        }
    }

    public function create(){
        return view('GestionRole.create');
    }

    public function login(Request $request)
    {
        $employes = Employe::all();
        $user = Employe::where('courriel', $request->courriel)->first();
        $categoriesLicences = CategoriesLicence::all();
        $licences = Licence::all();
        $fournisseurs = Fournisseur::all();
        $demandes = Demande::all();
        $infosRbq = InfosRbq::all();
    
        if (session()->has('user')) {
            logger('User session exists: ' . session('user'));
        } else {
            logger('No user session found.');
        }
    
        if ($user) {
            logger('Utilisateur connecté : ' . $user->courriel);
            Auth::login($user);
            logger('Utilisateur connecté : ' . $user->role);
            
            session(['user' => $user->courriel]);
    
            if ($user->role == "Administrateur") {
                return view('GestionRole.role', compact('employes'));
            } elseif ($user->role == "Responsable" || $user->role == "Commis") {
                return view('listeFournisseurs', compact('employes', 'categoriesLicences', 'licences', 'fournisseurs', 'demandes', 'infosRbq'));
            }
        } else {
            return redirect()->route('loginEmploye')->withErrors(["Information invalide"]);
        }
    }

    public function showLoginForm()
    {
        return View('GestionRole.login');
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

        public function afficherModeleCourriel(){
            return view('optionAdmin/modeleCourriel');
        }

        public function afficherParametre(){
            return view('optionAdmin/parametres');
        }
    }