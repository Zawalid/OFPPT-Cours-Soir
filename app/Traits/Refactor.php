<?php
namespace App\Traits;
trait Refactor {

  protected function refactorManyArticles($items){
    $array=[];
    foreach ($items as $item) {
          $item->pieceJointes;
          $item->Categories;
          $item->tags;
          $item->Admin;
          $item->AnneeFormations;
          $tags=[];
          $images=[];
          foreach($item->tags as $key ) {
            array_push($tags, $key['name']);
          };
          foreach($item->pieceJointes as $key ) {
            array_push($images,$key['URL']);
          };
          array_push($array, [ "id"=> $item->id,"title"=> $item->titre,"AnneeFormation"=>$item->AnneeFormations->nom,
          "content"=> $item->details, "author"=> $item->Admin->name,"date"=>$item->date,"tags"=>$tags,'cover'=>$images
        ]);
        }
        return $array;
  }
  
  protected function refactorOneArticle($item){
    $item->pieceJointes;
    $item->Categories;
    $item->tags;
    $item->AnneeFormations;

    $tags=[];
    $images=[];
    foreach($item->tags as $key ) {
      array_push($tags, $key['name']);
    };
    foreach($item->pieceJointes as $key ) {
      array_push($images,$key['URL']);
    };
    $item->Admin->name;
    return [ "id"=> $item->id,"title"=> $item->titre,"content"=> $item->details, "author"=> $item->Admin->name
    ,"AnneeFormation"=>$item->AnneeFormations->nom,"date"=>$item->date,"tags"=>$tags,'cover'=>$images
      ];
  }

protected function refactorManyEvents($items){
    $array=[];
    foreach ($items as $item) {
          $item->pieceJointes;
          $item->Categories;
          $item->tags;
          $item->Admin;
          $item->AnneeFormations;
          $tags=[];
          $images=[];
          foreach($item->tags as $key ) {
            array_push($tags, $key['name']);
          };
          foreach($item->pieceJointes as $key ) {
            array_push($images,$key['URL']);
          };
          array_push($array, [ "id"=> $item->id,"title"=> $item->titre,"AnneeFormation"=>$item->AnneeFormations->nom,
          "content"=> $item->details, "author"=> $item->Admin->name,"date"=>$item->date,'lieu'=>$item->lieu,'upcoming'=>$item->etat,
          "duree"=>$item->duree,"tags"=>$tags,'cover'=>$images
        ]);
        }
        return $array;
  }
  protected function refactorOneEvent($item){
     $item->pieceJointes;
          $item->Categories;
          $item->tags;
          $item->Admin;
          $item->AnneeFormations;
          $tags=[];
          $images=[];
          foreach($item->tags as $key ) {
            array_push($tags, $key['name']);
          };
          foreach($item->pieceJointes as $key ) {
            array_push($images,$key['URL']);
          };
          return [ "id"=> $item->id,"title"=> $item->titre,"AnneeFormation"=>$item->AnneeFormations->nom,
          "content"=> $item->details, "author"=> $item->Admin->name,"date"=>$item->date,'lieu'=>$item->lieu,'upcoming'=>$item->etat,
          "duree"=>$item->duree,"tags"=>$tags,'cover'=>$images
        ];
  }

  protected function refactorManyFiliers($items){
    $array=[];
    foreach ($items as $item) {
          $item->pieceJointes;
          $item->Secteur;
          $item->tags;
          $item->AnneeFormations;
          $tags=[];
          $images=[];
          foreach($item->tags as $key ) {
            array_push($tags, $key['name']);
          };
          foreach($item->pieceJointes as $key ) {
            array_push($images,$key['URL']);
          };
          array_push($array, [ "id"=> $item->id,"name"=> $item->titre,"AnneeFormation"=>$item->AnneeFormations->nom,
          "description"=> $item->details,"secteur"=>$item->Secteur->name,"tags"=>$tags,
          'cover'=>$images,'max_stagiaires'=>$item->max_stagiaires
        ]);
        }
        return $array;
  }
  protected function refactorOneFilier($item){
          $item->pieceJointes;
          $item->Secteur;
          $item->tags;
          $item->Admin;
          $item->AnneeFormations;
          $tags=[];
          $images=[];
          foreach($item->tags as $key ) {
            array_push($tags, $key['name']);
          };
          foreach($item->pieceJointes as $key ) {
            array_push($images,$key['URL']);
          };
         return  [ "id"=> $item->id,"name"=> $item->titre,"AnneeFormation"=>$item->AnneeFormations->nom,
          "description"=> $item->details, "secteur"=>$item->Secteur->name,"tags"=>$tags,
          'cover'=>$images,'max_stagiaires'=>$item->max_stagiaires
        ];
  }
}