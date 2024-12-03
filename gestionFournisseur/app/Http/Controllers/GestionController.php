<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CategoriesLicence;
use App\Models\Licence;
use App\Models\Contact;
use App\Http\Requests\UserRequest;
use App\Models\Service;
use App\Models\Brochure;

use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Mail\mailChangementEtat;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class GestionController extends Controller
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
        $etatDemande = User::where('id', $fournisseur->id)->get();
        $services = Service::where('fournisseur_id',  $fournisseur->id)->get();
        //$brochures = Brochure::where('fournisseur_id',  1000)->get();
        $brochures = [];
        
        return view('pageCommis.fiche', compact('fournisseur', 'contacts', 'services', 'brochures'));
    }

    public function updateEtat(UserRequest $request, User $fournisseur){
        Log::info('Received update request for fournisseur:', ['request_data' => $request->all()]);
        try{
            $fournisseur->etatDemande = $request->etatDemande;
            $fournisseur->save();

            Mail::to($fournisseur->email)->send(new MailChangementEtat($request->etatDemande, $fournisseur->email));
            return redirect()->route('pageCommis.liste')->with('message', 'Modification réussi');

        }
        catch(\Throwable $e){
            Log::error('Error during fournisseur update:', ['error' => $e->getMessage(), 'stack' => $e->getTraceAsString()]);
            return redirect()->route('pageCommis.liste')->withErrors('Erreur lors de la modification');
        }

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
        Log::info($request->all());
    
        $elements = explode(',', $request->checkedFournisseurs);
        $ids = [];
    
        foreach ($elements as $index => $value) {
            if ($value === 'true') {
                $ids[] = $index + 1;
            }
        }
    
        $users = User::whereIn('id', $ids)->get();
    
        $filteredFournisseurs = json_decode($request->input('filteredFournisseurs', '[]'), true);
        dd($filteredFournisseurs);
        $fournisseurs = !empty($users) ? $users->toArray() : $filteredFournisseurs;
    
        if (empty($fournisseurs)) {
            return response()->json(['error' => 'No fournisseurs to export.'], 400);
        }

        $response = new StreamedResponse(function() use ($fournisseurs) {
            $handle = fopen('php://output', 'w');
    
            if (!empty($fournisseurs)) {
                fputcsv($handle, array_keys($fournisseurs[0]));  
                foreach ($fournisseurs as $fournisseur) {
                    fputcsv($handle, array_values($fournisseur));
                }
            }
    
            fclose($handle);
        });
    
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="fournisseurs.csv"');
    
        return $response;
    }
    
}