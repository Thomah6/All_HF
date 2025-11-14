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
 Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id');
                $table->foreignId('user_id');
            $table->timestamps();
         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Définie une relation étrangère entre 'user_id' et 'id' de la table 'users'. Si un utilisateur est supprimé, tous ses commentaires seront supprimés aussi ('cascade')
         $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');  // Définie une relation étrangère entre 'user_id' et 'id' de la table 'users'. Si un utilisateur est supprimé, tous ses commentaires seront supprimés aussi ('cascade')

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
