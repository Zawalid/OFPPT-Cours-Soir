<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories =['education','joural','examen','inscription','nouveautés'];
        foreach ($categories as $categ) {
            $categorie = new Categorie();
            $categorie->name=$categ;
            $categorie->save();
            }
    }
}
