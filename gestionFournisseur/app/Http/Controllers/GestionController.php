<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\CategoriesLicence;
use App\Models\Licence;
use App\Models\Demande;
use App\Models\InfosRbq;
use App\Models\InfosUnspsc;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;

class gestionController extends Controller
{
    public function listeFournisseur() 
    {
        $fournisseurs = Fournisseur::all();
        $categoriesLicences = CategoriesLicence::all();
        $licences = Licence::all();
        $demandes = Demande::all();
        $infosRbq = InfosRbq::all();
        $infosUnspsc = InfosUnspsc::all();

        return View('pageCommis.listeFournisseurs', compact('fournisseurs', 'categoriesLicences', 'licences', 'demandes', 'infosRbq', 'infosUnspsc'));
    }

    public function zoom(Fournisseur $fournisseur) {
        $contacts = Contact::where('neqFournisseur',  $fournisseur->neq)->get();
        $demandes = Demande::where('neqFournisseur',  $fournisseur->neq)->get();
        $infosRbq = InfosRbq::where('neqFournisseur', $fournisseur->neq)->get();
        $infosUnspsc = InfosUnspsc::where('neqFournisseur', $fournisseur->neq)->get();

        return view('pageCommis.fiche', compact('fournisseur', 'contacts', 'demandes', 'infosRbq', 'infosUnspsc'));
    }

    public function listeContact(Request $request) {
        $ids = $request->query('ids');
        $request->session()->put('ids', $ids);
    
        $neqs = explode(',', $request->session()->get('ids'));
        $fournisseurs = Fournisseur::whereIn('neq', $neqs)->get();
        $contacts = Contact::whereIn('neqFournisseur', $neqs)->get();
    
        return View('pageCommis.liste-contact', compact('fournisseurs', 'contacts'));
    }

    public function exportFournisseurs(Request $request) {
        $checkedFournisseurs = json_decode($request->input('checkedFournisseurs', '[]'), true);
        $filteredFournisseurs = json_decode($request->input('filteredFournisseurs', '[]'), true);
    
        $fournisseurs = !empty($checkedFournisseurs) ? $checkedFournisseurs : $filteredFournisseurs;

        if (empty($fournisseurs)) {
            return response()->json(['error' => 'No fournisseurs to export.'], 400);
        }
    
        $response = new StreamedResponse(function() use ($fournisseurs) {
            $handle = fopen('php://output', 'w');
    
            fputcsv($handle, array_keys($fournisseurs[0]));
    
            foreach ($fournisseurs as $fournisseur) {
                fputcsv($handle, array_values($fournisseur));
            }
    
            fclose($handle);
        });
    
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="fournisseurs.csv"');
    
        return $response;
    }
    
}