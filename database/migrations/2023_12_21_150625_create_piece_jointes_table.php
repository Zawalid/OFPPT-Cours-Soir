<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('piece_jointes', function (Blueprint $table) {
            $table->id();
            $table->string('Nom');
            $table->string('URL');
            $table->integer('Taille');
            $table->string('Emplacement');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('evenements_id');
            $table->unsignedBigInteger('articles_id');
            $table->unsignedBigInteger('activites_id');
            $table->unsignedBigInteger('filiers_id');
            $table->foreign('evenements_id')->references('id')->on('evenements')->onDelete('cascade');
            $table->foreign('articles_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('activites_id')->references('id')->on('activites')->onDelete('cascade');
            $table->foreign('filiers_id')->references('id')->on('filiers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piece_jointes');
    }
};
