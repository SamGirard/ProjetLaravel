<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Employe;

class EmployeController extends Controller
{
    public function index(){
        $employes = Employe::all();

        return view('GestionRole.role', compact('employes'));
    }
}
