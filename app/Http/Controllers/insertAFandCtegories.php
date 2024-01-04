<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class insertAFandCtegories extends Controller
{
 public function insertAFandCtegories(){
      for ($year = 2000; $year <= 2100; $year++) {
    $academicYearStart = $year . '-11-01';
    $academicYearEnd = ($year + 1) . '-07-31';

    $data = [
        'nom' => $year . '/' . ($year + 1),
        'date_debut' => $academicYearStart,
        'date_fin' => $academicYearEnd,
        'active' => false,  // or false depending on your logic
        'date_debut_inscription' => $academicYearStart,
        'date_fin_inscription' => $academicYearEnd,
        'etat_inscription' => false,  // or false depending on your logic
        'created_at' => now(),
        'updated_at' => now(),
    ];

    DB::table('annee_formations')->insert($data);
}

    $categories =['education','joural','examen','inscription','nouveautés'];
    foreach ($categories as $categ) {
        $data2 =['nom'=>$categ,        'created_at' => now(),
        'updated_at' => now(),];
        DB::table('categories')->insert($data2);
        
    }
 }
}
