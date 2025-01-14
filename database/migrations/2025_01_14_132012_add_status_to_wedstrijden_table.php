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
        $table->string('status')->default('Niet begonnen'); // Voeg de status kolom toe
    });
}

public function down()
{
    Schema::table('wedstrijden', function (Blueprint $table) {
        $table->dropColumn('status'); // Verwijder de status kolom als de migratie wordt teruggedraaid
    });
}

};
