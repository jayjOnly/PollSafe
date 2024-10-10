<?php

namespace App\Http\Controllers;

use App\Models\candidates;
use App\Http\Requests\StorecandidatesRequest;
use App\Http\Requests\UpdatecandidatesRequest;

class CandidatesController extends Controller
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
     * @param  \App\Http\Requests\StorecandidatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecandidatesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\candidates  $candidates
     * @return \Illuminate\Http\Response
     */
    public function show(candidates $candidates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\candidates  $candidates
     * @return \Illuminate\Http\Response
     */
    public function edit(candidates $candidates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecandidatesRequest  $request
     * @param  \App\Models\candidates  $candidates
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecandidatesRequest $request, candidates $candidates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\candidates  $candidates
     * @return \Illuminate\Http\Response
     */
    public function destroy(candidates $candidates)
    {
        //
    }
}
