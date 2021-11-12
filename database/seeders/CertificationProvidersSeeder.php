<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificationProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certification_providers')->insert([
            'provider' => 'Udemy',
            'provider_logo' => 'img/logo-udemy.svg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('certification_providers')->insert([
            'provider' => 'EDX',
            'provider_logo' => 'img/edx-logo.svg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('certification_providers')->insert([
            'provider' => 'Udacity',
            'provider_logo' => 'img/Udacity_logo.svg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('certification_providers')->insert([
            'provider' => 'Coursera',
            'provider_logo' => 'img/coursera_logo.svg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
