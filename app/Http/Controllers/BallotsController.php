<?php

namespace App\Http\Controllers;

use App\Models\ballots;
use App\Http\Requests\StoreballotsRequest;
use App\Http\Requests\UpdateballotsRequest;

class BallotsController extends Controller
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
     * @param  \App\Http\Requests\StoreballotsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreballotsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ballots  $ballots
     * @return \Illuminate\Http\Response
     */
    public function show(ballots $ballots)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ballots  $ballots
     * @return \Illuminate\Http\Response
     */
    public function edit(ballots $ballots)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateballotsRequest  $request
     * @param  \App\Models\ballots  $ballots
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateballotsRequest $request, ballots $ballots)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ballots  $ballots
     * @return \Illuminate\Http\Response
     */
    public function destroy(ballots $ballots)
    {
        //
    }
}
