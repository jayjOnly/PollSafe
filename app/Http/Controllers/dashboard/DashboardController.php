<?php

namespace App\Http\Controllers\dashboard;

use App\Models\OrganizationVote;
use App\Models\OrganizationMember;
use App\Models\OrganizationVoteMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;  
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show() {
        return view('dashboard.dashboard');
    }

    public function index()
    {
        // Gunakan query yang sudah kita buat sebelumnya
        return response()->json($this->getActiveVotesForUser(Auth::id()));
    }

    function getActiveVotesForUser($userId) {
        $currentDate = Carbon::now();
    
        return DB::table('organization_votes')
            ->select([
                'organization_votes.id as vote_id',
                'organization_votes.name as vote_name',
                'organization_votes.description',
                'organization_votes.start_date',
                'organization_votes.end_date',
                DB::raw('IF(COUNT(DISTINCT organization_vote_candidates.organization_member_id) > 0, 100, 0) as participation_rate')
            ])
            ->join('organization_members', function ($join) use ($userId) {
                $join->on('organization_members.organization_id', '=', 'organization_votes.organization_id')
                     ->where('organization_members.user_id', '=', $userId);
            })
            ->leftJoin('organization_vote_candidates', function ($join) use ($userId) {
                $join->on('organization_vote_candidates.organization_vote_id', '=', 'organization_votes.id')
                     ->where('organization_vote_candidates.organization_member_id', '=', DB::raw("(SELECT id FROM organization_members WHERE user_id = '$userId' LIMIT 1)"));
            })
            ->where('organization_votes.start_date', '<=', $currentDate)
            ->where('organization_votes.end_date', '>=', $currentDate)
            ->groupBy('organization_votes.id', 'organization_votes.name', 'organization_votes.description', 'organization_votes.start_date', 'organization_votes.end_date')
            ->get();
    }
    
}
