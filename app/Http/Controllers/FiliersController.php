<?php

namespace App\Http\Controllers;

use App\Models\Filier;
use App\Models\AnneeFormation;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Requests\FiliersRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class FiliersController extends Controller{
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

public function create(){
     $activeAnneeFormations = AnneeFormation::active()->get()[0];
        if  (session::missing('anneeFormationActive')) {
        session(['anneeFormationActive' => $activeAnneeFormations]);
        }
        $AnneeFormation = AnneeFormation::all();
        return view("filiers.ajouter_filier",compact(['AnneeFormation']));
    }

public function store(FiliersRequest $request){
//store filier in DB
        $filier = new Filier();
        $filier->titre = $request->titre;
        $filier->details = $request->description;
        $filier->max_stagiaires = $request->max_stagiaires;
        $filier->active = $request->Active;
        $filier->visibility =true;
        $filier->user_id = auth()->user()->id;
        $filier->annee_formation_id = Session::get('anneeFormationActive')->id;
        $filier->save();     
//STORE filier files
        if ($request->has('images') && count($request->images) > 0) {
        foreach ($request->images as $image) {
            $imageURL =$image->getClientOriginalName();
            $filier->pieceJointes()->create([
                'nom'=>$request->titre,
                'taille'=> 11,
                'emplacement'=>public_path('images/filier'),
                'URL'=>$imageURL,
            ]);
            $image->move(public_path('images/filier'),$imageURL);
        }   
        }
//store tags 
        if ($request->has('tags') ) {
            foreach (explode(' ', $request->tags ) as $tag) {
                $filier->tags()->create([
                    'name'=>$tag,
                ]);
            }   
        } 
        return to_route("filiers.index");
    }
public function show(string $id)
    {
        $filier =   Filier::findOrFail($id);
        $pieceJointes=$filier->pieceJointes;
        $anneeFormation=$filier->AnneeFormations;
        return view('filiers.show_filier', compact( ['filier','anneeFormation','pieceJointes']));

    }

    public function edit(string $id) {
        $filier = Filier::findOrfail($id);
        $anneeFormation = AnneeFormation::all();
        $pieceJointes =$filier->pieceJointes;
        return view("filiers.edit_filier", compact("filier",'anneeFormation','pieceJointes'));
    }
public function cacher(Request $request ,string $id){
//casher Filier
    $filier = Filier::findOrFail($id);
    if($filier->visibility==='1'){ 
        $filier->visibility=0;
    }else{
        $filier->visibility=1;
    }
    $filier->save();
    return to_route('filiers.index');
    }

public function update(FiliersRequest $request, string $id) {
        $filier = Filier::findOrfail($id);
        $filier->titre = $request->titre;
        $filier->details = $request->description;
        $filier->max_stagiaires = $request->max_stagiaires;
        $filier->active = $request->active;
        $filier->annee_formation_id = $request->annee_formation;
//modify old files
        if ($request->has('oldImages')){
            foreach($filier->pieceJointes as $pj) {
                if (in_array( $pj->id, $request->oldImages)===false){
                    $filePath = public_path('images/fillier/'. $pj->URL);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                    $pj->delete();
                }
            }
        } else {
            foreach($filier->pieceJointes as $pj) {$pj->delete();}
        }
        $filier->save();
//add new files
        if ($request->hasfile('images') && count($request->images) > 0) {
            foreach ($request->images as $image) {
                $imageURL =$image->getClientOriginalName();
                $filier->pieceJointes()->create([
                    'nom'=>$request->titre,
                    'taille'=> 11,
                    'emplacement'=>public_path('images/fillier'),
                    'URL'=>$imageURL,
                ]);
                $image->move(public_path('images/fillier'),$imageURL);
            }   
        }
        return redirect()->route("filiers.index");
    }
public function destroy(string $id)  {
//move filier to trash
        $filier = Filier::findOrFail($id);
        $filier->delete();
        return redirect()->route("filiers.index");
    }
public function trash() {
//index of trashed filier
        $allPubliee = Filier::all();
        $allTrashed = Filier::onlyTrashed()->get();
        $user = Auth::user();
        $activeAnneeFormations = AnneeFormation::active()->get()[0];
        $publieeFiliers = Filier::paginate(5);
        $trashedFiliers = Filier::onlyTrashed()->paginate(5);
        return view('filiers.trash', compact(['publieeFiliers','trashedFiliers','user','activeAnneeFormations', 'allPubliee', 'allTrashed']));
    }
public function forceDelete(string $id) {
//forcee delete from trash
        $filier = Filier::onlyTrashed()->findOrFail($id);
        $filier->forceDelete();
            foreach ($filier->pieceJointes as $pj) {
            $pj->delete();
        }
        return redirect()->route('filiers.trash');
    }
public function restore(string $id) {
//restore from trash
    $filier = Filier::onlyTrashed()->findOrFail($id);
        $filier->restore();
        return redirect()->route('filiers.index');
    }
}
