<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\LicenseAttributeRepository;
use Exception;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class LicenseAttributeService
{
    /**
     * @var LicenseAttributeRepository $licenseAttributeRepository
     */
    protected $licenseAttributeRepository;

    public function __construct(LicenseAttributeRepository $licenseAttributeRepository)
    {
        $this->licenseAttributeRepository = $licenseAttributeRepository;
    }

    /**
     * Add License and Attribute content to cache.
     * in order to access it from anywere on app.
     * @param Type|null|string $content
     * @return bool
     */
    protected function cacheContent(?string $content): bool
    {
        if (is_null($content)) {
            return Cache::forget('licenseAttributeContent');
        }

        if (!is_null($content)) {
            return Cache::forever('licenseAttributeContent', $content);
        }
    }

    /**
     * display stored License and Attribute.
     * @param Type|null
     * @return object
     */
    public function getLicenseContent(): object
    {
        $licenseDetails = $this->licenseAttributeRepository->getLicenseFromStorage();
        return view('admin.licenseattributes', compact('licenseDetails'));
    }

    /**
     * Undocumented function
     *
     * @param Type|null $var
     * @return object
     */
    public function updateLicenseContent(object $request, int $id): object
    {
        $validator = Validator::make($request->all(), [
            'licenseContent' => 'nullable|string|max:80000',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $updateContent = $this->licenseAttributeRepository->updateLicenseOnStorage($id, $request->licenseContent);

            if ($updateContent) {
                $this->cacheContent($request->licenseContent);

                return redirect()->back()->with('successstatus', __('backendLang.updatedLicense'));
            }
            if (!$updateContent) {
                return back()->with('failedstatus', __('backendLang.failedToUpateLicanse'));
            }
        }
    }
}
