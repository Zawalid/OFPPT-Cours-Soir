<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnneeFormation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// Retrieve the currently authenticated user...

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
    $annesFormation = AnneeFormation::all();
    $activeAnneeFormations = AnneeFormation::active()->get()[0];
    if  (session::missing('anneeFormationActive')) {
        session(['anneeFormationActive' => $activeAnneeFormations]);
    }
    $user = Auth::user();
    session(['user'=>$user]);

    return view('home',compact(['annesFormation']));
    }
}
