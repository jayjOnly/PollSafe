<?php

namespace App\Http\Controllers\voting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function show() {
        return view('voting.active');
    }
}
