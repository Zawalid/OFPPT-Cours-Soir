<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\PieceJointe;
use App\Models\Categorie;
use App\Models\AnneeFormation;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;


class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $publieeArticles = Article::all();
        $allPubliee = Article::all();
        $activeAnneeFormations = AnneeFormation::active()->get()[0];
        $anneeFormation = AnneeFormation::all();
        $categorie = Categorie::all();
        $allTrashed = Article::onlyTrashed()->get();
        $publieeArticles = Article::paginate(5);
        $trashedArticles = Article::onlyTrashed()->paginate(5);
        return view("articles.articles", compact(["publieeArticles","trashedArticles", 'allPubliee',"allTrashed",'anneeFormation','categorie','activeAnneeFormations']));
}
    public function create()
    {
        $AnneeFormation = AnneeFormation::all();
        $Categorie = Categorie::all();
        return view('articles.ajouter_article',compact(["Categorie",'AnneeFormation']));
    }
    public function store(ArticleRequest $request)
    {
//store article in DB
    // dd($request->all());
       $article = new Article();
       $article->titre = $request->titre;
       $article->details = $request->description;
       $article->date = $request->date_publication;
       $article->auteur = $request->auteur;
       $article->categorie_id = $request->categorie;
       $article->annee_formation_id = $request->annee_formation;
       $article->thumbnail = $request->image->getClientOriginalName();
       $article->save();
//addArticlePrincipalImage
        $article->pieceJointes()->create([
            'nom'=>$request->titre,
            'taille'=> 11,
            'emplacement'=>public_path('images/article'),
            'URL'=>$request->image->getClientOriginalName(),
        ]);
        $request->image->move(public_path('images/article'),$request->image->getClientOriginalName());
//addAutresImages
        if ($request->has('images') && count($request->images) > 0) {
        foreach ($request->images as $image) {
            $imageURL =$image->getClientOriginalName();
            $article->pieceJointes()->create([
                'nom'=>$request->titre,
                'taille'=> 11,
                'emplacement'=>public_path('images/article'),
                'URL'=>$imageURL,
            ]);
            $image->move(public_path('images/article'),$imageURL);
        }   
        }
       return to_route('articles.index');
    }
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        $pieceJointes=$article->pieceJointes;
        $anneeFormation=$article->AnneeFormations;
        $Categorie=$article->Categories;
        return view('articles.show_article', compact( ['article','anneeFormation','Categorie','pieceJointes']));
    }
    public function edit(string $id)
    {
//GET ARTICLE TO MODIFIE
        $article = Article::findOrFail($id);
        $pieceJointes=$article->pieceJointes;
        $anneeFormation = AnneeFormation::all();
        $Categorie = Categorie::all();
        return view('articles.edit_article', compact( ['article','anneeFormation','Categorie','pieceJointes']));
    }

    public function update(Request $request, string $id)
    {
//MODIFIE ARTICLE
       $article = Article::findOrfail($id);
       $article->titre = $request->titre;
       $article->details = $request->description;
       $article->date = $request->date_publication;
       $article->auteur = $request->auteur;
       $article->thumbnail = $request->image;
       $article->categorie_id = $request->categorie;
       $article->annee_formation_id = $request->annee_formation;
       $article->save();
       return redirect()->route('articles.index');
    }

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
        foreach ($article->pieceJointes as $pj) {
            $pj->delete();
        }
        return redirect()->route('articles.trash');
    }
    public function restore(string $id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();
        return redirect()->route('articles.index');
    }
}
