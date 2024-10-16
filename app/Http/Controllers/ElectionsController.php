<?php

namespace App\Http\Controllers;

use App\Models\elections;
use App\Http\Requests\StoreelectionsRequest;
use App\Http\Requests\UpdateelectionsRequest;

class ElectionsController extends Controller
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
     * @param  \App\Http\Requests\StoreelectionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreelectionsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Elections  $elections
     * @return \Illuminate\Http\Response
     */
    public function show(Elections $elections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Elections  $elections
     * @return \Illuminate\Http\Response
     */
    public function edit(Elections $elections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateelectionsRequest  $request
     * @param  \App\Models\Elections  $elections
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateelectionsRequest $request, Elections $elections)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Elections  $elections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Elections $elections)
    {
        //
    }
}
