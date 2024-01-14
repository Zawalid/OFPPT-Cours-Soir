<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AnneeFormation;
class generalController extends Controller
{
// insert years
    public function insertAFandCtegories(){
    for ($year = 2010; $year <= 2040; $year++) {
        if ($year+1===getdate()['year']){$active=true;}   
        else {$active=false;}
        $academicYearStart = $year . '-09-01';
        $academicYearEnd = ($year + 1) . '-07-31';
        $data = [
        'nom' => $year . '/' . ($year + 1),
        'date_debut' => $academicYearStart,
        'date_fin' => $academicYearEnd,
        'active' =>  $active,  // or false depending on your logic
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
    $data2 =['nom'=>$categ,     
    'created_at' => now(),
    'updated_at' => now(),];
    DB::table('categories')->insert($data2);
    
}
return to_route('home');
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
            $af->active=0;
            $af->save();
        }
        $anneeFormation->active=1;
        $anneeFormation->save();
        return to_route('home');
    }
public function setActivInSession(Request $request){
   // dd($request->all());
    $request->session()->forget('anneeFormationActive');
    session(['anneeFormationActive'=>AnneeFormation::find($request->annee_formation_id)]);
    return to_route('home');
    }
}