<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\CategoriesLicence;
use App\Models\Licence;

class GestionController extends Controller
{
    public function listeFournisseur() 
    {
        $fournisseurs = Fournisseur::all();
        $categoriesLicences = CategoriesLicence::all();
        $licences = Licence::all();

        return View('listeFournisseurs', compact('fournisseurs', 'categoriesLicences', 'licences'));
    }
}
