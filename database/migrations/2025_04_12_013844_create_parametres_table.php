// database/migrations/[timestamp]_create_parametres_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parametres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_fm');
            $table->string('section');
            $table->string('heure');
            $table->string('nom');
            $table->string('valeur')->nullable();
            $table->timestamps();

            $table->foreign('id_fm')
                  ->references('id_fm')
                  ->on('feuilledemarche')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('parametres');
    }
};
