<?php

namespace App\Http\Controllers;

use App\Models\organizations;
use App\Http\Requests\StoreorganizationsRequest;
use App\Http\Requests\UpdateorganizationsRequest;

class OrganizationsController extends Controller
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
     * @param  \App\Http\Requests\StoreorganizationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreorganizationsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\organizations  $organizations
     * @return \Illuminate\Http\Response
     */
    public function show(organizations $organizations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\organizations  $organizations
     * @return \Illuminate\Http\Response
     */
    public function edit(organizations $organizations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateorganizationsRequest  $request
     * @param  \App\Models\organizations  $organizations
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateorganizationsRequest $request, organizations $organizations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\organizations  $organizations
     * @return \Illuminate\Http\Response
     */
    public function destroy(organizations $organizations)
    {
        //
    }
}
