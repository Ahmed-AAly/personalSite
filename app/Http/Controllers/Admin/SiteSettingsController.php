<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SiteSettingsService;

class SiteSettingsController extends Controller
{
    /**
     * @var SiteSettingsService $siteSettingsService
     */
    protected $siteSettingsService;

    public function __construct(SiteSettingsService $siteSettingsService)
    {
        $this->siteSettingsService = $siteSettingsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->siteSettingsService->getSettings();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->siteSettingsService->updateSettings($request);
    }
}
