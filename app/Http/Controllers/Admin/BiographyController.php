<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BiographyService;

class BiographyController extends Controller
{
    /**
     * @var BiographyService $biographyService
     */
    protected $biographyService;

    public function __construct(BiographyService $biographyService)
    {
        $this->biographyService = $biographyService;
    }

    /**
     * Display biography admin home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): object
    {
        return $this->biographyService->getBiography();
    }


    /**
     * Update biography in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request): object
    {
        return $this->biographyService->updateBiography($request);
    }
}
