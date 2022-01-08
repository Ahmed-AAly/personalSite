<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_attributes', function (Blueprint $table) {
            $table->id();
            $table->mediumText('license_attributes')->nullable()->default(null);;
            $table->timestamps();
        });

        $seeder = new Database\Seeders\LicenseAttributesSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('license_attributes');
    }
}
