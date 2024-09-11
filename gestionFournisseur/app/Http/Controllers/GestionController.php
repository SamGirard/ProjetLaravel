<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Fournisseur;

class GestionController extends Controller
{
    public function listeFournisseur() 
    {
        // $fournisseurs = Fournisseur:all();

        // return View('listeFournisseurs', compact('fournisseurs'));
        return View('listeFournisseurs');
    }
}
