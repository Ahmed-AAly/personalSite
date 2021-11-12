<?php

namespace App\Http\Controllers\PublicUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biography;

class AboutMeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getBiography = Biography::latest()->first();

        return view('welcome', compact('getBiography'));
    }
}
