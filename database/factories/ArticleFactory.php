<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{

    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'titre' => $this->faker->title(),
           'details'=> $this->faker->paragraph(),
           'date'=> $this->faker->date(),
           'auteur'=> $this->faker->name(),
           'thumbnail'=> $this->faker->sentence(15),
           'categorie_id'=> 1,
           'annee_formation_id'=> 1,
        ];
    }
}
