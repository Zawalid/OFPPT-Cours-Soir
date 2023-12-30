<?php

namespace App\Http\Controllers;

use App\Models\Filier;
use Illuminate\Http\Request;
use App\Http\Requests\FiliersRequest;

class FiliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPubliee = Filier::all();
        $allTrashed = Filier::onlyTrashed()->get();
        $publieeFiliers = Filier::paginate(5);
        $trashedFiliers = Filier::onlyTrashed()->paginate(5);
        return view("filiers.filiers", compact(["publieeFiliers","trashedFiliers", 'allPubliee', 'allTrashed']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("filiers.ajouter_filier");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FiliersRequest $request)
    {
        $filier = new Filier();
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
        $filier = Filier::findOrfail($id);
        return view("filiers.edit_filier", compact("filier"));
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

    /**
     * Remove the specified resource from storage.
     */
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
