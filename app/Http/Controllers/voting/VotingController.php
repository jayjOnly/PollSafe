<?php

namespace App\Http\Controllers\voting;

use App\Http\Controllers\Controller;
use App\Models\OrganizationVote;
use App\Models\OrganizationMember;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    public function show($organization_id) {
        $isMember = OrganizationMember::where('organization_id', $organization_id)
            ->where('user_id', Auth::id())
            ->exists();
        
        if(!$isMember){
            abort(403, 'Forbidden');
        }

        $votes = OrganizationVote::where('organization_id', $organization_id)
            ->where('end_date', '>', Carbon::now()->toIso8601String())
            ->withCount('vote_members')  // Counts votes_member records for each vote
            ->get();

        // Prepare the response
        $organization_vote_list = $votes->map(function ($vote) {
            return [
                'id' => $vote->id,
                'name' => $vote->name,
                'vote_member_count' => $vote->vote_members_count, // This contains the count of votes_members
                'end_date' => $vote->end_date,
            ];
        });
        return view('voting.active', compact('organization_id', 'organization_vote_list'));
    }
}
