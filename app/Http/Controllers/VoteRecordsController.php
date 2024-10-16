<?php

namespace App\Http\Controllers;

use App\Models\vote_records;
use App\Http\Requests\Storevote_recordsRequest;
use App\Http\Requests\Updatevote_recordsRequest;
use App\Models\VoteRecords;

class VoteRecordsController extends Controller
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
     * @param  \App\Http\Requests\Storevote_recordsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storevote_recordsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoteRecords  $vote_records
     * @return \Illuminate\Http\Response
     */
    public function show(VoteRecords $vote_records)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoteRecords  $vote_records
     * @return \Illuminate\Http\Response
     */
    public function edit(VoteRecords $vote_records)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatevote_recordsRequest  $request
     * @param  \App\Models\VoteRecords  $vote_records
     * @return \Illuminate\Http\Response
     */
    public function update(Updatevote_recordsRequest $request, VoteRecords $vote_records)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoteRecords  $vote_records
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoteRecords $vote_records)
    {
        //
    }
}
