<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('wedstrijden', function (Blueprint $table) {
            $table->integer('score_team1')->default(0); // Voeg de score voor team 1 toe
            $table->integer('score_team2')->default(0); // Voeg de score voor team 2 toe
        });
    }

    public function down()
    {
        Schema::table('wedstrijden', function (Blueprint $table) {
            $table->dropColumn(['score_team1', 'score_team2']); // Verwijder de scorekolommen bij terugdraaien
        });
    }
};
