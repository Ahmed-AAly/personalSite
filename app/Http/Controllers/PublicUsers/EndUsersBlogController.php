<?php

namespace App\Http\Controllers\PublicUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BlogService;

class EndUsersBlogController extends Controller
{
    /**
     * @var BlogService $blogService
     */
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->blogService->frontEndIndexPage();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->blogService->readPostContent($id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->blogService->searchPost($request);
    }
}
