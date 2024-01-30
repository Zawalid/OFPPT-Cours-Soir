<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories =['education','joural','examen','inscription','nouveautés'];
        foreach ($categories as $categ) {
            $data2 =['nom'=>$categ,     
            'created_at' => now(),
            'updated_at' => now(),];
            DB::table('categories')->insert($data2);

            }
    }
}
