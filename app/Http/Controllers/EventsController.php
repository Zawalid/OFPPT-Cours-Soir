<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Http\Requests\EventsRequest;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPubliee = Evenement::all();
        $allTrashed = Evenement::onlyTrashed()->get();
        $publieeEvenements = Evenement::paginate(5);
        $trashedEvenements = Evenement::onlyTrashed()->paginate(5);
        return view("evenements.evenements", compact(["publieeEvenements", "trashedEvenements", 'allPubliee', "allTrashed"]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("evenements.ajouter_evenement");
    }

    /**
     * Store a newly created resource in storage.
     */
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
        $evenement->thumbnail = $request->file;
        $evenement->save();
        return redirect()->route('evenements.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evenement = Evenement::findOrFail($id);
        return view('evenements.edit_evenement', compact('evenement'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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
        return redirect()->route('evenements.trash');
    }
    public function restore(string $id)
    {
        $evenement = Evenement::onlyTrashed()->findOrFail($id);
        $evenement->restore();
        return redirect()->route('evenements.index');
    }
}
