// database/migrations/[timestamp]_add_id_fm_to_parametres_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdFmToParametresTable extends Migration
{
    public function up()
    {
        Schema::table('parametres', function (Blueprint $table) {
            // Ajoutez la colonne id_fm
            $table->unsignedBigInteger('id_fm')->nullable()->after('id');

            // Ajoutez la contrainte de clé étrangère après avoir rempli les données
        });

        // Si vous avez déjà des données, vous pouvez leur attribuer une valeur par défaut
        // DB::table('parametres')->update(['id_fm' => 1]); // Exemple avec valeur par défaut 1
    }

    public function down()
    {
        Schema::table('parametres', function (Blueprint $table) {
            // Supprimez d'abord la contrainte de clé étrangère si elle existe
            $table->dropForeign(['id_fm']);

            // Puis supprimez la colonne
            $table->dropColumn('id_fm');
        });
    }
}
