<?php

namespace App\Http\Controllers;

use App\Models\voters;
use App\Http\Requests\StorevotersRequest;
use App\Http\Requests\UpdatevotersRequest;

class VotersController extends Controller
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
     * @param  \App\Http\Requests\StorevotersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorevotersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voters  $voters
     * @return \Illuminate\Http\Response
     */
    public function show(Voters $voters)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voters  $voters
     * @return \Illuminate\Http\Response
     */
    public function edit(Voters $voters)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatevotersRequest  $request
     * @param  \App\Models\Voters  $voters
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatevotersRequest $request, Voters $voters)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voters  $voters
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voters $voters)
    {
        //
    }
}
