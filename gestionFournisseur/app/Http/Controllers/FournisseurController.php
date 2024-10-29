<?php

namespace App\Http\Controllers;

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
