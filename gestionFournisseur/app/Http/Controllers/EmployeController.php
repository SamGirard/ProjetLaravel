<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Employe;
use App\Http\Requests\EmployeRequest;

class EmployeController extends Controller
{
    public function index(){
        $employes = Employe::all();

        return view('GestionRole.role', compact('employes'));
    }

    public function create(){
        return view('GestionRole.create');
    }

    public function login(Request $request){
        $courriel = $request->input('courriel');

        // Rechercher l'utilisateur par courriel
        $employe = Employe::where('courriel', $courriel)->first();

        if ($employe) {
            // Authentifier l'utilisateur sans utiliser le mot de passe
            Auth::login($employe);
            return redirect()->route("liste");
        } else {
            return redirect()->route('loginEmploye')->withErrors(['courriel' => 'Le courriel fourni est invalide.']);
        }
    }

    public function showLoginForm()
    {
        return View('GestionRole.login');
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
    }