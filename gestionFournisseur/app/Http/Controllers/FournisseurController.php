<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'neq' => ['required','size:10','regex:/^(11|22|33|88)[4-9]\d{7}$/'],
            'nom'=>'required|max:64',
            'email' => 'required|email|max:64',
        ]);
        session(['validation_identification' => 'ok']);
        return redirect()->route('create_service');
    }

    public function create_service(Request $request)
    {
        if($request->session()->get('validation_identification')=="ok")
            return view('fournisseur/form_produit_service');
        else
            return view('fournisseur/form_identification');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
        //
    }
}
