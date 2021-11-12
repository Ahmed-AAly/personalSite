<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContactMeService;

class HomeController extends Controller
{
    /**
     * @var ContactMeService $contactMeService
     */
    protected $contactMeService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ContactMeService $contactMeService)
    {
        $this->middleware('auth');
        $this->contactMeService = $contactMeService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return $this->contactMeService->getAllContactMessages();
    }
}
