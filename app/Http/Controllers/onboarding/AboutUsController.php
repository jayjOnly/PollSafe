<?php

namespace App\Http\Controllers\onboarding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function show() {
        return view('onboarding.about-us');
    }
}
