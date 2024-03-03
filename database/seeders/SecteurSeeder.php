<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Secteur;
class SecteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $secteurs =['Gestion et Commerce','Agriculture','Agro-Industrie','Arts et Industries Graphiques','Artisanat','Digital et Intelligence Artificielle','Audiovisuel et Cinéma','Matériaux de Construction','Bâtiment et Travaux Publics'];
        foreach ($secteurs as $name) {
            $secteur = new Secteur();
            $secteur->name=$name;
            $secteur->save();
            }
    }
}
