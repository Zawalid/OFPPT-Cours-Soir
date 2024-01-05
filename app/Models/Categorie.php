<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable=['nom'];
    use HasFactory;
     public function articles(){
    return $this->hasMany(Article::class,'categorie_id');
  }
}
