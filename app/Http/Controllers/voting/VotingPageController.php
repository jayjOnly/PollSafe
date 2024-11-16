<?php

namespace App\Http\Controllers\voting;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\OrganizationVote;
use App\Models\OrganizationVoteCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VotingPageController extends Controller
{
    public function show($organization_vote_id) {
        $vote = OrganizationVote::where('id', $organization_vote_id)->first();
        $isMember = OrganizationMember::where('organization_id', $vote->organization_id)
            ->where('user_id', Auth::id())
            ->exists();
        
        if(!$isMember){
            abort(403, 'Forbidden');
        }
        $candidates = OrganizationVoteCandidate::where('organization_vote_id', $organization_vote_id)->get()->map(function ($candidate) {
            return [
                "id" => $candidate->id,
                "name" => OrganizationMember::where('id', $candidate->organization_member_id)->first()->user->name,
                'image' => 'JV.png'
            ];
        });
        return view('voting.votingPage', compact('vote', 'candidates'));
    }
}


