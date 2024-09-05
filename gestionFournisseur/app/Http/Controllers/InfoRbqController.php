<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\InfosRbq;

class InfoRbqController extends Controller
{
    public function index(){
        // Récupérer tous les fournisseurs
        $infosRbq = InfosRbq::all();

        // Passer les données à la vue
        return view('test', compact('infosRbq'));
    }
}
