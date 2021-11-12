<?php

namespace App\Repositories;

use App\Models\SiteSetting;

class SiteSettingsRepository
{
    /**
     * @var SiteSetting $siteSetting
     */
    protected $siteSetting;

    public function __construct(SiteSetting $siteSetting)
    {
        $this->siteSetting = $siteSetting;
    }

    /**
     * get site settings from storage.
     * @param Type|void
     * @return object
     */
    public function getSettingsFromStorage(): object
    {
        return $this->siteSetting->select('id', 'settings_name', 'settings_value')->get();
    }

    /**
     * Update site settings on storage.
     * @param Type|string $imgPath
     * @param Type|string $title
     * @return bool
     */
    public function updateSettingsOnStorage(
        string $settingsName,
        string $settingValue
    ): bool {
        try {
            $this->siteSetting->where('settings_name', $settingsName)
            ->update(['settings_value' => $settingValue]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
