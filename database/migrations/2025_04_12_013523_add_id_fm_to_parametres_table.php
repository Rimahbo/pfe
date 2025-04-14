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
        Schema::table('parametres', function (Blueprint $table) {
            // Ajoutez la colonne id_fm
            $table->unsignedBigInteger('id_fm')->nullable()->after('id');

            // Si vous avez des données existantes, vous pouvez ajouter :
            // DB::table('parametres')->update(['id_fm' => 1]); // Valeur par défaut
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parametres', function (Blueprint $table) {
            $table->dropColumn('id_fm');
        });
    }
};
