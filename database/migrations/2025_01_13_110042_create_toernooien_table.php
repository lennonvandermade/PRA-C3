<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('toernooien', function (Blueprint $table) {
            $table->id();
            $table->string('naam'); // Naam van het toernooi
            $table->timestamp('startdatum')->nullable(); // Startdatum van het toernooi
            $table->string('status')->default('in_afwachting'); // Status van het toernooi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('toernooien');
    }
};
