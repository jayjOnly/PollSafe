<?php

namespace App\Http\Controllers\voting;

use App\Http\Controllers\Controller;
use App\Models\OrganizationMember;
use App\Models\OrganizationVote;
use App\Models\OrganizationVoteCandidate;
use App\Models\OrganizationVoteMember;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function show($organization_id) {
        $isMember = OrganizationMember::where('organization_id', $organization_id)
            ->where('user_id', Auth::id())
            ->exists();
        
        if(!$isMember){
            abort(403, 'Not authorized');
        }

        $votes = OrganizationVote::where('organization_id', $organization_id)
            ->where('end_date', '<', Carbon::now()->toIso8601String())
            ->withCount('vote_members')  // Counts votes_member records for each vote
            ->get();

        // Prepare the response
        $organization_vote_list = $votes->map(function ($vote) {
            $candidates = OrganizationVoteCandidate::where('organization_vote_id', $vote->id)->get()->map(function ($candidate) use ($vote) {
                $count = count(OrganizationVoteMember::where('organization_vote_id', $vote->id)->where('organization_vote_candidate_id', $candidate->id)->get());
                return [
                    "name" => OrganizationMember::where('id', $candidate->organization_member_id)->first()->user->name,
                    "count" => $count
                ];
            });

            return [
                'id' => $vote->id,
                'name' => $vote->name,
                'vote_member_count' => $vote->vote_members_count, // This contains the count of votes_members
                'end_date' => $vote->end_date,
                'winner' => $candidates->sortByDesc('count')->first()['name'],
            ];
        });
        return view('voting.history', compact('organization_id', 'organization_vote_list'));
    }
}
