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
}
