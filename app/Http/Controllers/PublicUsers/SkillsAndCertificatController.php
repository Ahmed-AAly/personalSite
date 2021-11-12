<?php

namespace App\Http\Controllers\PublicUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SkillsService;
use App\Services\CertificationsService;

class SkillsAndCertificatController extends Controller
{

    /**
     * @var SkillsService $skillsService
     */
    protected $skillsRepositery;

    /**
     * @var CertificationsService $certificationsService
     */
    protected $certificationsService;

    public function __construct(SkillsService $skillsService, CertificationsService $certificationsService)
    {
        $this->skillsService = $skillsService;
        $this->certificationsService = $certificationsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $getSkillsList = $this->skillsService->getActiveSkills();
        $getCertList = $this->certificationsService->getAllCerts();

        return view('skills-certifications', compact('getSkillsList', 'getCertList'));
    }
}
