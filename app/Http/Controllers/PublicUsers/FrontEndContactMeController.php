<?php

namespace App\Http\Controllers\PublicUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ContactMeService;

class FrontEndContactMeController extends Controller
{
    /**
     * @var ContactMeService $contactMeService
     */
    protected $contactMeService;

    public function __construct(ContactMeService $contactMeService)
    {
        $this->contactMeService = $contactMeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->contactMeService->contactForm();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->contactMeService->storeContact($request);
    }
}
