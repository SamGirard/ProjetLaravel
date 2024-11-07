<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Mail\ModificationFournisseur;
use App\Models\Contact;
use App\Models\Parametre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function create_contact(){
        return view('profile.ajouter_contact');
    }

    public function create_finance(){
        return view('profile.ajouter_finances');
    }

    public function store_finance(Request $request){
        $validated = $request->validate([
            'num_tps'=>'required',
            'num_tvq'=>'required',
            'condition_paiement'=>'required',
            'devise'=>'required',
            'mode_communication'=>'required'
        ]);

        auth()->user()->numTPS = $request->input('num_tps');
        auth()->user()->numTVQ = $request->input('num_tvq');
        auth()->user()->conditionPaiement = $request->input('num_tvq');
        auth()->user()->modeCommunication = $request->input('mode_communication');
        auth()->user()->devise = $request->input('devise');
        auth()->user()->save();

        Mail::to(Parametre::first()->courrielAppro)->send(
            new ModificationFournisseur(['nom'=>auth()->user()->nomEntreprise,'message'=>DB::table('modele_courriel')->select('message')->where('objet', 'Bonjour')->first()->message])
        );
        return redirect()->route('dashboard')->with(['ajouter_finance' => 'données de finances ajoutées!']);
    }
    public function destroyContact($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            Mail::to(Parametre::first()->courrielAppro)->send(
                new ModificationFournisseur(['nom'=>auth()->user()->nomEntreprise,'message'=>DB::table('modele_courriel')->select('message')->where('objet', 'Bonjour')->first()->message])
            );
            return redirect()->route('dashboard')->with(['supprimer_contact' => 'contact supprimé']);
        }
    }
}
