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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('actif');
            $table->string('TypeTransaction');
            $table->integer('quantuite');
            $table->date('date');
            $table->float('prixTotal');
            $table->boolean('limitBuy')->nullable()->default(null);
            $table->float('limitBuyPrice')->nullable()->default(null);
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('porteFeuilleID');
            $table->foreign('porteFeuilleID')->references('id')->on('porte_feuille_virtuels')->onDelete('cascade')->onUpdate('cascade');
            $table->string('buyOrsell');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
