<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ContactMeService;

class ContactMeController extends Controller
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
     * Remove the specified resource from storage.
     *
     * @param  Type|object $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->contactMeService->removeMessage($request);
    }
}
