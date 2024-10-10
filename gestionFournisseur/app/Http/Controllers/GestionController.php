<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\CategoriesLicence;
use App\Models\Licence;
use App\Models\Demande;
use App\Models\InfosRbq;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function zoom(Fournisseur $fournisseur) {
        return view('fiche', compact('fournisseur'));
    }

    public function listeContact(Request $request) {
        $ids = $request->query('ids');
        $request->session()->put('ids', $ids);
    
        $idsArray = explode(',', $request->session()->get('ids'));
        $fournisseurs = Fournisseur::whereIn('neq', $idsArray)->get();
        $contacts = Contact::all();
    
        return View('liste-contact', compact('fournisseurs', 'contacts'));
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