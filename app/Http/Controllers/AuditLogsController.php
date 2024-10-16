<?php

namespace App\Http\Controllers;

use App\Models\audit_logs;
use App\Http\Requests\Storeaudit_logsRequest;
use App\Http\Requests\Updateaudit_logsRequest;
use App\Models\AuditLogs;

class AuditLogsController extends Controller
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
     * @param  \App\Http\Requests\Storeaudit_logsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeaudit_logsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AuditLogs  $audit_logs
     * @return \Illuminate\Http\Response
     */
    public function show(AuditLogs $audit_logs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuditLogs  $audit_logs
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditLogs $audit_logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateaudit_logsRequest  $request
     * @param  \App\Models\AuditLogs  $audit_logs
     * @return \Illuminate\Http\Response
     */
    public function update(Updateaudit_logsRequest $request, AuditLogs $audit_logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuditLogs  $audit_logs
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditLogs $audit_logs)
    {
        //
    }
}
