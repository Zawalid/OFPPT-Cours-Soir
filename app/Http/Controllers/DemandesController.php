<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Http\Requests\DemandeRequest;

class DemandesController extends Controller
{
    public function index()   {
        $demandes = Demande::all();
        return view('demandes.demandes',compact('demandes'));
    }

      public function trash(){
        $demandes =Demande::onlyTrashed()->get();
        return view('demandes.trash',compact('demandes'));

    }
    public function store(DemandeRequest $request){
        $demande = new Demande();
        $demande->name=$request->name;
        $demande->subject=$request->subject;
        $demande->phoneNumber=$request->phoneNumber;
        $demande->email=$request->email;
        $demande->details=$request->details;
        if ($demande->save()){
            return 1;
        }
    }

    public function show(Demande $demande){
        return view('demandes.show',compact('demande'));
    }
    public function destroy(Demande $demande){
        $demande->delete();
        $demandes = Demande::all();
        return view('demandes.demandes',compact('demandes'));
    }
  
    public function restore($id){
        $demande=Demande::onlyTrashed()->findOrFail($id);
        $demande->restore();
        $demandes=Demande::onlyTrashed()->get();
        return view('demandes.trash',compact('demandes'));
        }
}
