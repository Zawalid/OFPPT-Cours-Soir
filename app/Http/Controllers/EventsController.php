<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\PieceJointe;
use App\Models\Categorie;
use App\Models\AnneeFormation;

use Illuminate\Http\Request;
use App\Http\Requests\EventsRequest;


class EventsController extends Controller
{
    public function index()
    {
        $allPubliee = Evenement::all();
        $anneeFormation = AnneeFormation::all();
        $categorie = Categorie::all();
        $allTrashed = Evenement::onlyTrashed()->get();
        $publieeEvenements = Evenement::paginate(5);
        $trashedEvenements = Evenement::onlyTrashed()->paginate(5);
        return view("evenements.evenements", compact(["publieeEvenements", "trashedEvenements", 'allPubliee', "allTrashed","anneeFormation",'categorie']));
    }

    public function create()
    {
        $AnneeFormation = AnneeFormation::all();
        return view("evenements.ajouter_evenement",compact(['AnneeFormation']));
    }

    public function store(EventsRequest $request)
    {
        $evenement = new Evenement();
        $evenement->titre = $request->titre;
        $evenement->details = $request->description;
        $evenement->date = $request->date_evenement;
        $evenement->lieu = $request->lieu;
        $evenement->duree = $request->duree;
        $evenement->etat = $request->etat;
        $evenement->annee_formation_id = $request->annee_formation;
        $evenement->thumbnail = $request->image->getClientOriginalName();
        $evenement->save();
        //addArticlePrincipalImage
        $evenement->pieceJointes()->create([
            'nom'=>$request->titre,
            'taille'=> 11,
            'emplacement'=>public_path('images/evenement'),
            'URL'=>$request->image->getClientOriginalName(),
        ]);
        $request->image->move(public_path('images/evenement'),$request->image->getClientOriginalName());
        // //addAutresImages
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

    public function show(string $id)
    {
        $evenement = Evenement::findOrFail($id);
        $pieceJointes=$evenement->pieceJointes;
        $anneeFormation=$evenement->AnneeFormations;
        return view('evenements.show_evenement', compact( ['evenement','anneeFormation','pieceJointes']));

    }

    public function edit(string $id)
    {
        $evenement = Evenement::findOrFail($id);
        $anneeFormation = AnneeFormation::all();
        $pieceJointes=$evenement->pieceJointes;
        return view('evenements.edit_evenement', compact('evenement','anneeFormation','pieceJointes'));
    }

    public function update(EventsRequest $request, string $id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->titre = $request->titre;
        $evenement->details = $request->description;
        $evenement->date = $request->date_evenement;
        $evenement->lieu = $request->lieu;
        $evenement->duree = $request->duree;
        $evenement->etat = $request->etat;
        $evenement->annee_formation_id = $request->annee_formation;
        $evenement->thumbnail = $request->file;
        $evenement->save();
        return redirect()->route('evenements.index');
    }

    public function destroy(string $id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->delete();
        return redirect()->route('evenements.index');
    }
    public function trash()
    {
        $allPubliee = Evenement::all();
        $allTrashed = Evenement::onlyTrashed()->get();
        $publieeEvents = Evenement::paginate(5);
        $trashedEvents = Evenement::onlyTrashed()->paginate(5);
        return view('evenements.trash', compact(['publieeEvents','trashedEvents', 'allPubliee', 'allTrashed']));
    }
    public function forceDelete(string $id)
    {
        $evenement = Evenement::onlyTrashed()->findOrFail($id);
        $evenement->forceDelete();
          foreach ($evenement->pieceJointes as $pj) {
            $pj->delete();
        }
        return redirect()->route('evenements.trash');
    }
    public function restore(string $id)
    {
        $evenement = Evenement::onlyTrashed()->findOrFail($id);
        $evenement->restore();
        return redirect()->route('evenements.index');
    }
}
