<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\PieceJointe;
use App\Models\Categorie;
use App\Models\AnneeFormation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\EventsRequest;
use Illuminate\Support\Facades\Session;


class EvenementsController extends Controller{
public function index(){
        $allPubliee = Evenement::all();
        $anneeFormation = AnneeFormation::all();
        $categorie = Categorie::all();
        $allTrashed = Evenement::onlyTrashed()->get();
        $publieeEvenements = Evenement::paginate(5);
        $trashedEvenements = Evenement::onlyTrashed()->paginate(5);
        return view("evenements.evenements", compact(["publieeEvenements","trashedEvenements", 'allPubliee', "allTrashed","anneeFormation",'categorie']));
    }

public function create(){
        $AnneeFormation = AnneeFormation::all();
        $activeAnneeFormations = AnneeFormation::active()->get()[0];
        if  (session::missing('anneeFormationActive')) {
        session(['anneeFormationActive' => $activeAnneeFormations]);
        }
        return view("evenements.ajouter_evenement",compact(['AnneeFormation']));
    }

public function store(EventsRequest $request){
//store evenement in DB
        $evenement = new Evenement();
        $evenement->titre = $request->titre;
        $evenement->details = $request->description;
        $evenement->date = $request->date_evenement;
        $evenement->lieu = $request->lieu;
        $evenement->duree = $request->duree;
        $evenement->etat = $request->etat;   
        $evenement->user_id = auth()->user()->id;
        $evenement->visibility =true;
        $evenement->annee_formation_id = Session::get('anneeFormationActive')->id;
        $evenement->save();
//store event's files
        if ($request->hasfile('images') && count($request->images) > 0) {
            foreach ($request->images as $image) {
                $imageURL =$image->getClientOriginalName();
                $evenement->pieceJointes()->create([
                    'nom'=>$request->titre,
                    'taille'=> 11,
                    'emplacement'=>public_path('images/evenement'),
                    'URL'=>$imageURL,
                ]);
                $image->move(public_path('images/evenement'),$imageURL);
            }   
        }
//store tags 
        if ($request->has('tags') ) {
            foreach (explode(' ', $request->tags ) as $tag) {
                $evenement->tags()->create([
                    'name'=>$tag,
                ]);
            }   
        }
    return redirect()->route('evenements.index');

    }

public function show(string $id){
//show evenemt by ID
    $evenement = Evenement::findOrFail($id);
        return view('evenements.show_evenement', compact( 'evenement'));
    }
public function cacher(Request $request ,string $id){
//afficher & cacher evenemet
    $evenement = Evenement::findOrFail($id);
    if($evenement->visibility==='1'){ 
        $evenement->visibility=0;
    }else{
        $evenement->visibility=1;
    }
    $evenement->save();
    return to_route('evenements.index');
    }
public function edit(string $id){
//get element by id to modify it
        $evenement = Evenement::findOrFail($id);
        $anneeFormation = AnneeFormation::all();
        return view('evenements.edit_evenement', compact('evenement','anneeFormation'));
    }

public function update(Request $request, string $id) {
       // dd($request->all());
//update event info
        $evenement = Evenement::findOrFail($id);
        $evenement->titre = $request->titre;
        $evenement->details = $request->description;
        $evenement->date = $request->date_evenement;
        $evenement->lieu = $request->lieu;
        $evenement->duree = $request->duree;
        $evenement->etat = $request->etat;
        $evenement->annee_formation_id = $request->annee_formation;
        $evenement->save();
//modify old files
         if ($request->has('oldImages')){
            foreach($evenement->pieceJointes as $pj) {
                if (in_array( $pj->id, $request->oldImages)===false){
                    $filePath = public_path('images/evenement/'. $pj->URL);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                   $pj->delete();
                }
            }
        } else {
            foreach($evenement->pieceJointes as $pj) {$pj->delete();}
        }
//add new files
        if ($request->hasfile('images') && count($request->images) > 0) {
            foreach ($request->images as $image) {
                $imageURL =$image->getClientOriginalName();
                $evenement->pieceJointes()->create([
                    'nom'=>$request->titre,
                    'taille'=> 11,
                    'emplacement'=>public_path('images/evenement'),
                    'URL'=>$imageURL,
                ]);
                $image->move(public_path('images/evenement'),$imageURL);
            }   
        }
    return redirect()->route('evenements.index');

    }

public function destroy(string $id) {
//move event to trash
        $evenement = Evenement::findOrFail($id);
        $evenement->delete();
        return redirect()->route('evenements.index');
    }
public function trash(){
//index of trashed events
        $allPubliee = Evenement::all();
        $allTrashed = Evenement::onlyTrashed()->get();
        $user = Auth::user();
        $publieeEvents = Evenement::paginate(5);
        $trashedEvents = Evenement::onlyTrashed()->paginate(5);
        return view('evenements.trash', compact(['publieeEvents','trashedEvents','user','allPubliee', 'allTrashed']));
    }
public function forceDelete(string $id){
//Force delete from trash 
        $evenement = Evenement::onlyTrashed()->findOrFail($id);
        $evenement->forceDelete();
          foreach ($evenement->pieceJointes as $pj) {
            $pj->delete();
        }
        return redirect()->route('evenements.trash');
    }
public function restore(string $id){
//restore events from trash
        $evenement = Evenement::onlyTrashed()->findOrFail($id);
        $evenement->restore();
        return redirect()->route('evenements.index');
    }
}
