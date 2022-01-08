<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class LicenseAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('license_attributes')->insert([
            'license_attributes' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // during first installtion, we cache the site settings.
        // it can later be updated by the site adminstrator from teh adminstration area.
        if (!Cache::has('siteSettings')) {
            Cache::rememberForever('siteSettings', function () {
                $siteSettingsCache = ['maintenancemode' => 'false'];
                return $siteSettingsCache;
            });
        }
    }
}
