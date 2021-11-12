<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FirstTimeInstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('biographies')->insert(
            [
            'biography' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset 
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software 
                like Aldus PageMaker including versions of Lorem Ipsum.",
            'image' => '',
            'created_at' => now(),
            'updated_at' => now()
            ]
        );

        DB::table('users')->insert(
            [
            'name' => 'Admin User',
            'email' => 'admin@test.invalid',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
            ]
        );
    }
}
