<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Filier;
use App\Models\AnneeFormation;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Requests\FiliersRequest;

class FiliersController extends Controller
{

    public function index()
    {
        $allPubliee = Filier::all();
        $anneeFormation = AnneeFormation::all();
        $categorie = Categorie::all();
        $allTrashed = Filier::onlyTrashed()->get();
        $publieeFiliers = Filier::paginate(5);
        $trashedFiliers = Filier::onlyTrashed()->paginate(5);
        return view("filiers.filiers", compact(["publieeFiliers","trashedFiliers", 'allPubliee', 'allTrashed','anneeFormation','categorie']));
    }

    public function create()
    {
        $AnneeFormation = AnneeFormation::all();
        return view("filiers.ajouter_filier",compact(['AnneeFormation']));
    }

    public function store(FiliersRequest $request)
    {
        //dd($request->all());
        $filier = new Filier();
        $filier->titre = $request->titre;
        $filier->details = $request->description;
        $filier->max_stagiaires = $request->max_stagiaires;
        $filier->active = $request->Active;
        $filier->annee_formation_id = $request->annee_formation;
        $filier->thumbnail = $request->image->getClientOriginalName();
        $filier->number_stagiaires = 20;
        $filier->save();
        
        $filier->pieceJointes()->create([
            'nom'=>$request->titre,
            'taille'=> 11,
            'emplacement'=>public_path('images\filliers'),
            'URL'=>$request->image->getClientOriginalName(),
        ]);
        $request->image->move(public_path('images\filliers'),$request->image->getClientOriginalName());
        // //addAutresImages
        if ($request->has('images') && count($request->images) > 0) {
        foreach ($request->images as $image) {
            $imageURL =$image->getClientOriginalName();
            $filier->pieceJointes()->create([
                'nom'=>$request->titre,
                'taille'=> 11,
                'emplacement'=>public_path('images\filliers'),
                'URL'=>$imageURL,
            ]);
            $image->move(public_path('images/filliers'),$imageURL);
        }   
        }
        
        return to_route("filiers.index");
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $filier = Filier::findOrfail($id);
        $anneeFormation = AnneeFormation::all();
        $pieceJointes =$filier->pieceJointes;
        return view("filiers.edit_filier", compact("filier",'anneeFormation','pieceJointes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FiliersRequest $request, string $id)
    {
        $filier = Filier::findOrfail($id);
        $filier->titre = $request->titre;
        $filier->details = $request->description;
        $filier->max_stagiaires = $request->max_stagiaires;
        $filier->active = $request->active;
        $filier->annee_formation_id = $request->annee_formation;
        $filier->thumbnail = $request->file;
        $filier->number_stagiaires = 20;
        // $filier->number_stagiaires = $request->number_stagiaires;
        $filier->save();
        return redirect()->route("filiers.index");
    }

    public function destroy(string $id)
    {
        $filier = Filier::findOrFail($id);
        $filier->delete();
        return redirect()->route("filiers.index");
    }
    public function trash()
    {
        $allPubliee = Filier::all();
        $allTrashed = Filier::onlyTrashed()->get();
        $publieeFiliers = Filier::paginate(5);
        $trashedFiliers = Filier::onlyTrashed()->paginate(5);
        return view('filiers.trash', compact(['publieeFiliers','trashedFiliers', 'allPubliee', 'allTrashed']));
    }
    public function forceDelete(string $id)
    {
        $article = Filier::onlyTrashed()->findOrFail($id);
        $article->forceDelete();
        return redirect()->route('filiers.trash');
    }
    public function restore(string $id)
    {
        $article = Filier::onlyTrashed()->findOrFail($id);
        $article->restore();
        return redirect()->route('filiers.index');
    }
}
