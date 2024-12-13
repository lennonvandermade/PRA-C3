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
        Schema::create('inschrijvingen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();  // Zorg ervoor dat deze relatie bestaat
            $table->foreignId('team_id')->constrained();  // Verbind met teams tabel
            $table->timestamps();
        });
        Schema::table('inschrijvingen', function (Blueprint $table) {
            $table->foreign('team_id')
                  ->references('id')->on('teams')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inschrijvingen');
    }
};
