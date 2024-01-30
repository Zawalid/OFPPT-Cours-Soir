<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AnneeFormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
