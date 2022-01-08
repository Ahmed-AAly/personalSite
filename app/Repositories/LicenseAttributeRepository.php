<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\LicenseAttributes;

class LicenseAttributeRepository
{
    /**
     * @var LicenseAttributes $licenseAttributes
     */
    protected $licenseAttributes;

    public function __construct(LicenseAttributes $licenseAttributes)
    {
        $this->licenseAttributes = $licenseAttributes;
    }

    /**
     * get license & Attributesfrom storage.
     * @param Type|void
     * @return object
     */
    public function getLicenseFromStorage(): object
    {
        return $this->licenseAttributes->select('id', 'license_attributes')->first();
    }

    /**
     * Update license and attributes on storage.
     * @param Type|string $imgPath
     * @param Type|string $title
     * @return bool
     */
    public function updateLicenseOnStorage(
        int $id,
        ?string $content
    ): bool {
        try {
            $this->licenseAttributes->where('id', $id)
            ->update(['license_attributes' => $content]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
