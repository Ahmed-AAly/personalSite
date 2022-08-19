<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\SiteSettingsRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class SiteSettingsService
{
    /**
     * @var SiteSettingsRepository $siteSettingsRepository
     */
    protected $siteSettingsRepository;

    public function __construct(SiteSettingsRepository $siteSettingsRepository)
    {
        $this->siteSettingsRepository = $siteSettingsRepository;
    }

    /**
     * This method handles caching the site settngs once invoked.
     * This is done in order to avoid unreasonable DB calls.
     * During first time installtion this method is not invoked,
     * however all cache are loaded directly once settings migration are done
     * via the seeder class, this is done as a work arround, and will be improved,
     * in the future.
     * @param Type|null $var
     * @return object
     */
    public function getSettings(): array
    {

        $value = Cache::rememberForever('siteSettings', function () {

            $currentSettings = $this->siteSettingsRepository->getSettingsFromStorage();
            $settingsArray = [];
            foreach ($currentSettings as $key => $value) {
                $settingsArray[$value['settings_name']] = $value['settings_value'];
            }
            return $settingsArray;
        });
        return $value;
    }

    /**
     * update biography.
     * @param Type|object $request
     * @return Type|object \Illuminate\Http\Response
     */
    public function updateSettings(object $request): object
    {

        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'maintenancemode' => 'nullable|string|in:on',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            } else {
                if ((string) $request->maintenancemode === 'on') {
                    $request->maintenancemode = 'true';
                } else {
                    $request->maintenancemode = 'false';
                }

                $updateStatus = $this->siteSettingsRepository
                ->updateSettingsOnStorage('maintenancemode', (string) $request->maintenancemode);

                if ($updateStatus) {
                    // if all went well, we forget the old cached values, and reassign the updated once.
                    Cache::forget('siteSettings');
                    $this->getSettings();
                    // Then we reture sucess status to user.
                    return response()->json('success', 200);
                }
                if (!$updateStatus) {
                    return response()->json('failed', 422);
                }
            }
        };
    }
}
