<?php

namespace App\Http\Controllers;

use App\Models\DockCategory;
use App\Http\Requests\StoreDockCategoryRequest;
use App\Http\Requests\UpdateDockCategoryRequest;

class DockCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDockCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDockCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DockCategory  $dockCategory
     * @return \Illuminate\Http\Response
     */
    public function show(DockCategory $dockCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DockCategory  $dockCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(DockCategory $dockCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDockCategoryRequest  $request
     * @param  \App\Models\DockCategory  $dockCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDockCategoryRequest $request, DockCategory $dockCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DockCategory  $dockCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DockCategory $dockCategory)
    {
        //
    }
}
