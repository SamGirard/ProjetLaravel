<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        return redirect()->back()->with('success', 'Les employés sonts modifiés.');
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