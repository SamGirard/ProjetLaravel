<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;


use App\Http\Requests\EmployeRequest;
use App\Http\Requests\CourrielRequest;
use App\Http\Requests\ParametreRequest;

use App\Mail\MailConnection;

use App\Models\Parametre;
use App\Models\Courriel;
use App\Models\RoleCourriel;
use App\Models\Employe;



class EmployeController extends Controller
{
    public function index(){
        
    }

    public function create(){
        return view('GestionRole.create');
    }


    //LOGIN EMPLOYE
    public function login()
    {
        request()->validate(['courriel' => 'required']);
        $user = Employe::where(['courriel' => request('courriel')])->first();

        if (!$user) {
            return redirect()->back()->withErrors(['courriel' => 'Employé introuvable']);
        }

        Auth::login($user);
        session()->regenerate();   
        
        Mail::to($user->courriel)->send(new MailConnection($user->role));

        // Rediriger l'utilisateur vers la bonne vue selon son rôle
        // Rediriger l'utilisateur selon son rôle
        if ($user->role == "Administrateur") {
            return redirect()->route('role');

        } elseif ($user->role == "Responsable" || $user->role == "Commis") {
            return redirect()->route('pageCommis.liste');
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


    //UPDATE EMPLOYE
    public function store(EmployeRequest $request){
        try{
            $employe = Employe::create($request->all());
            $employe->save();
        }
        catch(\Throwable $e){
            Log::debug($e);
        }
        return redirect()->route('role')->with('success', 'Employé ajouté avec succès!');
    }

    public function update(Request $request)
    {
        try {
            // Pas besoin de créer un nouvel employé ici
            foreach($request->input('employes') as $employeData) {
                // Vérifier si le courriel et le rôle sont bien définis
                if (isset($employeData['courriel'], $employeData['role'])) {
                    \App\Models\Employe::where('courriel', $employeData['courriel'])->update([
                        'role' => $employeData['role'],
                    ]);
                } else {
                    Log::debug("Missing role or courriel for employee: ", $employeData);
                }
            }
        } catch (\Throwable $e) {
            Log::debug($e);
            Log::debug($request->input('employes'));  // Log all input for better debug info
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

        //ROLE
        public function afficherRole(){
            $employes = Employe::all();

            return view('GestionRole.role', compact('employes'));
        }

        //PARAMETRE//
        public function afficherParametre(){
            $parametres = Parametre::all();

            return view('optionAdmin/parametres', compact('parametres'));
        }

        public function updateParam(ParametreRequest $request){
            try {
                $parametre = Parametre::first();

                $parametre->courrielAppro = $request->courrielAppro;
                $parametre->delaiRevision = $request->delai;
                $parametre->tailleMaxFichiers = $request->taille;
                $parametre->courrielFinance = $request->courrielFinance;

                $parametre->save();
                return redirect()->route('parametre')->with('success', 'Modification réussie');

            }catch(\Throwable $e){
                Log::debug($e);
                return redirect()->route('parametre')->withErrors(['Modification réussie']);
             }
             return redirect()->route('parametre');
        }


        //MODELE COURRIEL
        public function afficherModeleCourriel(){
            $courriels = Courriel::all();
            $roleCourriels = Rolecourriel::all();

            return view('optionAdmin/modeleCourriel', compact('courriels', 'roleCourriels'));
        }

        
        public function storeCourrielRole(Request $request){
            try{
                $roleCourriel = new RoleCourriel($request->all());
                $roleCourriel->save();
            }
            catch(\Throwable $e){
                Log::debug($e);
            }
            return redirect()->route('modeleCourriel')->with('success', 'Rôle ajouté avec succès!');
        }


        public function updateCourriel(CourrielRequest $request){
            try{
                $courriel = Courriel::first();

                $courriel->objet = $request->objet;
                $courriel->message = $request->message;
                $courriel->role = $request->role;
                $courriel->raison = $request->raison;

                $courriel->save();
                return redirect()->route('modeleCourriel')->with('success', 'Le modèle de courriel est modifier!');
            }
            catch(\Throwable $e){
                return redirect()->route('modeleCourriel')->withErrors('Erreur lors de la modification!');
            }
            return redirect()->route('modeleCourriel');
        }


    public function destroyRoleCourriel(Request $request){
        $roles = new RoleCourriel($request->all());

        if ($request->has('roleCourriel')) {
            // Boucler sur chaque employé (par courriel) et les supprimer
            foreach ($request->input('roleCourriel') as $role) {
                $role_detail = RoleCourriel::where('role', $role)->first();
                if ($role_detail) {
                    $role_detail->delete();
                }
            }
        }
    
        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Les rôles sélectionnés ont été supprimés.');
    }
}