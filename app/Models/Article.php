<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable=["titre","details",'auteur','date','image'];

    public function pieceJointes() {
 	    return $this->morphMany(PieceJointe::class, 'PieceJointeable'); 
	}
    public function AnneeFormations(){
    return $this->belongsTo(AnneeFormation::class,'annee_formation_id');
  }


}
