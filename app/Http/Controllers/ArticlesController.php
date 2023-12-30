<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $publieeArticles = Article::all();
        $allPubliee = Article::all();
        $allTrashed = Article::onlyTrashed()->get();
        $publieeArticles = Article::paginate(5);
        $trashedArticles = Article::onlyTrashed()->paginate(5);
        return view("articles.articles", compact(["publieeArticles","trashedArticles", 'allPubliee',"allTrashed"]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.ajouter_article');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
       $article = new Article();
       $article->titre = $request->titre;
       $article->details = $request->description;
       $article->date = $request->date_publication;
       $article->auteur = $request->auteur;
       $article->thumbnail = $request->file;
       $article->categorie_id = $request->categorie;
       $article->annee_formation_id = $request->annee_formation;
       $article->save();
       return redirect()->route('articles.index');
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
        $article = Article::findOrFail($id);
        return view('articles.edit_article', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $article = Article::findOrfail($id);
       $article->titre = $request->titre;
       $article->details = $request->description;
       $article->date = $request->date_publication;
       $article->auteur = $request->auteur;
       $article->thumbnail = $request->file;
       $article->categorie_id = $request->categorie;
       $article->annee_formation_id = $request->annee_formation;
       $article->save();
       return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('articles.index');
    }
    public function trash()
    {
        $allPubliee = Article::all();
        $allTrashed = Article::onlyTrashed()->get();
        $publieeArticles = Article::paginate(5);
        $trashedArticles = Article::onlyTrashed()->paginate(5);
        return view('articles.trash', compact(['publieeArticles','trashedArticles', 'allPubliee', 'allTrashed']));
    }
    public function forceDelete(string $id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->forceDelete();
        return redirect()->route('articles.trash');
    }
    public function restore(string $id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();
        return redirect()->route('articles.index');
    }
}
