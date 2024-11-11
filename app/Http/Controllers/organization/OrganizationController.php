<?php

namespace App\Http\Controllers\organization;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrganizationController extends Controller
{
    public function show() {
        return view('organization.organization');
    }
}
