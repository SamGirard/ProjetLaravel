<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\CategoriesLicence;
use App\Models\Licence;
use App\Models\Demande;
use App\Models\InfosRbq;
use App\Models\Contact;

class GestionController extends Controller
{
    public function listeFournisseur() 
    {
        $fournisseurs = Fournisseur::all();
        $categoriesLicences = CategoriesLicence::all();
        $licences = Licence::all();
        $demandes = Demande::all();
        $infosRbq = InfosRbq::all();

        return View('listeFournisseurs', compact('fournisseurs', 'categoriesLicences', 'licences', 'demandes', 'infosRbq'));
    }

    public function listeContact(Request $request) {
        $ids = $request->query('ids');
        $request->session()->put('ids', $ids);
    
        $idsArray = explode(',', $request->session()->get('ids'));
        $fournisseurs = Fournisseur::whereIn('neq', $idsArray)->get();
        $contacts = Contact::all();
    
        return view('liste-contact', compact('fournisseurs', 'contacts'));
    }
}
