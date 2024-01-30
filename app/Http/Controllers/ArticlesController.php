<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\PieceJointe;
use App\Models\User;
use App\Models\Categorie;
use App\Models\AnneeFormation;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use File;

class ArticlesController extends Controller
{
public function __construct(){
        $this->middleware('auth');
    }
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
        $admins = User::all();
        $Categorie = Categorie::all();
         $activeAnneeFormations = AnneeFormation::active()->get()[0];
        if  (session::missing('anneeFormationActive')) {
        session(['anneeFormationActive' => $activeAnneeFormations]);
        }
        return view('articles.ajouter_article',compact(["Categorie",'AnneeFormation','admins']));
    }
public function store(ArticleRequest $request){
//store article in DB
    $article = new Article();
    $article->titre = $request->titre;
    $article->details = $request->description;
    $article->date = $request->date_publication;
    $article->user_id = auth()->user()->id;
    $article->visibility =true;
    $article->categorie_id = $request->categorie;
    $article->annee_formation_id = Session::get('anneeFormationActive')->id;
    $article->save();
//store files
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
        };
        if ($request->has('tags') ) {
            foreach (explode(' ', $request->tags ) as $tag) {
                $article->tags()->create([
                    'name'=>$tag,
                ]);
            }   
        }
       return to_route('articles.index');
    }
public function show(Article $article){
//showArticle           
        $article['details']=Str::markdown($article->details);
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
public function edit(Article $article){
//GET ARTICLE TO MODIFIE
        $pieceJointes=$article->pieceJointes;
        $anneeFormation = AnneeFormation::all();
        $admins = User::all();
        $Categorie = Categorie::all();
        return view('articles.edit_article', compact( ['article','admins','anneeFormation','Categorie','pieceJointes']));
    }

public function update(ArticleRequest $request, string $id){
//MODIFIE ARTICLE
        $article = Article::findOrfail($id);
        $article->titre = $request->titre;
        $article->details = $request->description;
        $article->date = $request->date_publication;
        if(isset($request->user)){
            $article->user_id = $request->user;
        }else{
            $article->user_id = Session::get('user')->id;
        }
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
public function destroy(Article $article){
//move  to trash
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
