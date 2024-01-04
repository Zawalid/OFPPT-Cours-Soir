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
            $table->string('titre');
            $table->text('details');
            $table->string('thumbnail');
            $table->boolean('active')->nullable();
            $table->integer('number_stagiaires');
            $table->integer('max_stagiaires');
            $table->foreignId('annee_formation_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
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
