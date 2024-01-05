<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnneeFormation;
class generalController extends Controller
{
// insert years
    public function insertAFandCtegories(){
    for ($year = 2010; $year <= 2040; $year++) {
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
//insert categories 
    $categories =['education','joural','examen','inscription','nouveautés'];
    foreach ($categories as $categ) {
        $data2 =['nom'=>$categ,        'created_at' => now(),
        'updated_at' => now(),];
        DB::table('categories')->insert($data2);
        
    }
 }
//get all AF to settings 
    public function getAf(){
    $annesFormation = AnneeFormation::all();
    return view('settings.index',compact(['annesFormation']));
    }
    public function setActiveAF(Request $request){
        $anneeFormation = AnneeFormation::findOrfail($request->annee_formation_id);
        $anneesFormation=AnneeFormation::all();
        foreach ($anneesFormation as $af) {
            $af->active =0;
            $af->save();
        }
        $anneeFormation->active=1;
        $anneeFormation->save();
        return to_route('settings.index');
    }
}
