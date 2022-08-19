<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LicenseAttributeService;

class LicenseAttributeController extends Controller
{
    /**
     * @var LicenseAttributeService $licenseAttributeService
     */
    protected $licenseAttributeService;

    public function __construct(LicenseAttributeService $licenseAttributeService)
    {
        $this->licenseAttributeService = $licenseAttributeService;
    }

    /**
     * Display license & Attributes in admin page.
     * @param Type|void
     * @return \Illuminate\Http\Response
     */
    public function index(): object
    {
        return $this->licenseAttributeService->getLicenseContent();
    }

    /**
     * Handles updting license & attributes request.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id): object
    {
        return $this->licenseAttributeService->updateLicenseContent($request, $id);
    }
}
