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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('author',255);
        $table->foreignId('user_id');
        $table->boolean('is_published')->default(0);
            $table->timestamps();
         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Définie une relation étrangère entre 'user_id' et 'id' de la table 'users'. Si un utilisateur est supprimé, tous ses commentaires seront supprimés aussi ('cascade')

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
