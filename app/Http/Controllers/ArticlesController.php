<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\PieceJointe;
use App\Models\Categorie;
use App\Models\AnneeFormation;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use File;

class ArticlesController extends Controller
{
public function index(){
//table all articles
        $allPubliee = Article::all();
        $anneeFormation = AnneeFormation::all();
        $categorie = Categorie::all();
        $allTrashed = Article::onlyTrashed()->get();
        $publieeArticles = Article::paginate(10);
        $trashedArticles = Article::onlyTrashed()->paginate(10);
        return view("articles.articles", compact(["publieeArticles","trashedArticles",'allPubliee',"allTrashed",'anneeFormation','categorie']));
    }
public function create(){
//form to add article
        $AnneeFormation = AnneeFormation::all();
        $Categorie = Categorie::all();
        return view('articles.ajouter_article',compact(["Categorie",'AnneeFormation']));
    }
public function store(ArticleRequest $request){
//store article in DB
    $article = new Article();
    $article->titre = $request->titre;
    $article->details = $request->description;
    $article->date = $request->date_publication;
    $article->auteur = $request->auteur;
    $article->visibility =true;
    $article->categorie_id = $request->categorie;
    $article->annee_formation_id = $request->annee_formation;
    $article->save();
//store thubmnail 
        $article->pieceJointes()->create([
            'nom'=>$request->titre,
            'taille'=> 11,
            'emplacement'=>public_path('images/article'),
            'URL'=>$request->image->getClientOriginalName(),
        ]);
        $request->image->move(public_path('images/article'),$request->image->getClientOriginalName());
//store autre file
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
public function show( $id){
//showArticle           
        $article = Article::findOrFail($id);
        $pieceJointes=$article->pieceJointes;
        $anneeFormation=$article->AnneeFormations;
        $Categorie=$article->Categories;
        return view('articles.show_article', compact( ['article','anneeFormation','Categorie','pieceJointes']));
    }
public function cacher(Request $request ,string $id){
//casher article
    $article = Article::findOrFail($id);
    if($article->visibility==='1'){ 
        $article->visibility=0;
    }else{
        $article->visibility=1;
    }
    $article->save();
    return to_route('articles.index');}
public function edit(string $id){
//GET ARTICLE TO MODIFIE
        $article = Article::findOrFail($id);
        $pieceJointes=$article->pieceJointes;
        $anneeFormation = AnneeFormation::all();
        $Categorie = Categorie::all();
        return view('articles.edit_article', compact( ['article','anneeFormation','Categorie','pieceJointes']));
    }

public function update(ArticleRequest $request, string $id){
//MODIFIE ARTICLE
        $article = Article::findOrfail($id);
        $article->titre = $request->titre;
        $article->details = $request->description;
        $article->date = $request->date_publication;
        $article->auteur = $request->auteur;
        $article->categorie_id = $request->categorie;
        $article->annee_formation_id = $request->annee_formation;
        $article->save();
//modify old files
        if ($request->has('oldImages')){
            foreach($article->pieceJointes as $pj) {
                if (in_array( $pj->id, $request->oldImages)===false){
                    $filePath = public_path('images/article/'. $pj->URL);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                   $pj->delete();
                }
            }
        } else {
            foreach($article->pieceJointes as $pj) {$pj->delete();}
        }
//add new file
          if ($request->hasfile('images') && count($request->images) > 0) {
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

        return redirect()->route('articles.index');
    }
public function destroy(string $id){
//move  to trash
        $article = Article::findOrFail($id);
        $article->delete();    
        return redirect()->route('articles.index');
    }
public function trash(){
//table articles in trash
        $allPubliee = Article::all();
        $user = Auth::user();
        $activeAnneeFormations = AnneeFormation::active()->get()[0];
        $allTrashed = Article::onlyTrashed()->get();
        $publieeArticles = Article::paginate(5);
        $trashedArticles = Article::onlyTrashed()->paginate(5);
        return view('articles.trash', compact(['publieeArticles','trashedArticles', 'user','activeAnneeFormations','allPubliee', 'allTrashed']));
    }
public function forceDelete(string $id){
//force delete from trash
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->forceDelete();
        foreach($article->pieceJointes as $pj) {
            $pj->delete();
        }
        return redirect()->route('articles.trash');
    }
public function restore(string $id){
//restore Article from trush
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();
        return redirect()->route('articles.index');
    }
}
