<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\CertificationProvidersSeeder;

class CreateCertificationProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification_providers', function (Blueprint $table) {
            $table->id();
            $table->string('provider',255);
            $table->string('provider_logo',100);
            $table->timestamps();
        });

        $seeder = new CertificationProvidersSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certification_providers', function (Blueprint $table) {
            //
        });
    }
}
