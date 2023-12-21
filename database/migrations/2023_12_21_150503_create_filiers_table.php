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
        Schema::create('filiers', function (Blueprint $table) {
            $table->id();
            $table->string('Nom');
            $table->text('Description');
            $table->boolean('Active');
            $table->integer('Number_Stagiaires');
            $table->integer('Max_Stagiaires');
            $table->unsignedBigInteger('Annee_Formation_id');
            $table->foreign('Annee_Formation_id')->references('id')->on('Annee_Formation')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filiers');
    }
};
