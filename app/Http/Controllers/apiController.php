<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Article;
use App\models\Filier;
use App\models\Evenement;
use App\models\Categorie;
use App\models\Tag;
use App\models\Secteur;
use App\Traits\Refactor;
class apiController extends Controller

{
    use Refactor;
//Articles ApiS
    public function getArticleById($id){
        $article =Article::where("id",$id)->where('visibility',1)->first();
        if ( $article ){ 
            return  response()->json($this->refactorOneArticle($article)) ;
        }
    }
    public function getVisibleArticles(){
        return response()->json($this->refactorManyArticles(Article::visibleArticles()));
    }
    public function getOrderedArticles(){
        return response()->json($this->refactorManyArticles(Article::visibleArticles()));
    }
    
    public function getLatestArticle(){
        return response()->json($this->refactorOneArticle(Article::latestArticle()));
    }
//events Apis
    public function getVisibleEvents(){
        return response()->json($this->refactorManyEvents(Evenement::VisibleEvents()));
    }
     public function getEventById($id){
        $event = Evenement::find($id);
        if ($event){
            return response()->json($this->refactorOneEvent($event));
        }
        return ;
    }
//filiers Apis
    public function getActiveFiliers(){
        return response()->json($this->refactorManyFiliers(Filier::ActiveFiliers()));
    }
    public function getAllFiliers(){
        return response()->json($this->refactorManyFiliers(Filier::All()));
    }
  
    public function getGroupediliers(){
        return response()->json((Filier::GroupedFiliers()));
    }
    public function getFilierById($id){
        $fillier =Filier::find($id);
        if ($fillier){
            return response()->json($this->refactorOneFilier($fillier));
        };
    }
      public function getFiliersBySecteurs($id){
        return response()->json($this->refactorManyFiliers(Filier::filiersBySecteurs($id)));
    }
//secteurs
public function getAllSeteurs(){
        return response()->json((Secteur::NameSecteur()));
    }
public function getAllTags(){
        return response()->json((Tag::tags()));
    }
public function getAllcategories(){
        return response()->json((Categorie::categories()));
    }
}
