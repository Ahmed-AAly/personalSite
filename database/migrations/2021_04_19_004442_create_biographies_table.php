<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\FirstTimeInstallSeeder;

class CreateBiographiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biographies', function (Blueprint $table) {
            $table->id();
            $table->mediumText('biography');
            $table->string('image', 255);
            $table->timestamps();
        });

        $seeder = new FirstTimeInstallSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biographies');
    }
}
