<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CategoriesLicence;
use App\Models\Licence;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Brochure;
use Symfony\Component\HttpFoundation\StreamedResponse;

class gestionController extends Controller
{
    public function listeFournisseur() 
    {
        $fournisseurs = User::all();
        $categoriesLicences = CategoriesLicence::all();
        $licences = Licence::all();
        $services = Service::all();

        return View('pageCommis.listeFournisseurs', compact('fournisseurs', 'categoriesLicences', 'licences', 'services'));
    }

    public function zoom(User $fournisseur) {
        $contacts = Contact::where('fournisseur_id',  $fournisseur->id)->get();
        $services = Service::where('fournisseur_id',  $fournisseur->id)->get();
        $brochures = Brochure::where('fournisseur_id',  $fournisseur->id)->get();

        return view('pageCommis.fiche', compact('fournisseur', 'contacts', 'services', 'brochures'));
    }

    public function listeContact(Request $request) {
        $ids = $request->query('ids');
        $request->session()->put('ids', $ids);
    
        $id = explode(',', $request->session()->get('ids'));
        $fournisseurs = User::whereIn('id', $id)->get();
        $contacts = Contact::whereIn('fournisseur_id', $id)->get();
    
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