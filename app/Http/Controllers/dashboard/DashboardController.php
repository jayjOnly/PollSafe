<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OrganizationVote;
use App\Models\Organization;
use App\Models\Users;
use App\Models\OrganizationMember;
use App\Models\OrganizationVoteCandidate;
use App\Models\OrganizationVoteMember;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function show() {
        $userId = Auth::id(); 

        $votes = OrganizationVote::whereHas('organization', function ($query) use ($userId) {
            $query->whereHas('users', function ($memberQuery) use ($userId) {
                $memberQuery->where('user_id', $userId);
            });
        })
        ->where('end_date', '>', Carbon::now()->toIso8601String())
        ->with(['organization'])
        ->with(['vote_members' => function ($query) use ($userId) {
            // Join with organization_members table to get the correct member_id
            $query->whereIn('organization_member_id', function ($subQuery) use ($userId) {
                $subQuery->select('organization_members.id')
                         ->from('organization_members')
                         ->join('organization_votes', 'organization_votes.organization_id', '=', 'organization_members.organization_id')
                         ->where('organization_members.user_id', $userId)
                         ->whereColumn('organization_votes.id', 'organization_vote_members.organization_vote_id');
            });
        }])
        ->get();
        

        // Prepare the response
        $organization_vote_list = $votes->map(function ($vote) {
            return [
                'id' => $vote->id,
                'name' => $vote->name,
                'organization' =>$vote->organization->name,
                'vote_status' => $vote->vote_members->isNotEmpty(), // Checks if the user has voted
                'end_date' => $vote->end_date,
                'organization_id' => $vote->organization->id

            ];
        });

        $history_votes = OrganizationVote::whereHas('organization', function ($query) use ($userId) {
            $query->whereHas('users', function ($memberQuery) use ($userId) {
                $memberQuery->where('user_id', $userId);
            });
        })
        ->where('end_date', '<', Carbon::now()->toIso8601String()) //  active votes
        ->with(['vote_members' => function ($query) use ($userId) {
            $query->where('user_id', $userId); // Check if user has voted
        }])
        ->get();

        // Prepare the response
        $organization_history_vote_list = $history_votes->map(function ($vote) {
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
                'organization' => $vote->organization->name,
                'vote_member_count' => $candidates->sortByDesc('count')->first()['count'], // This contains the count of votes_members
                'end_date' => $vote->end_date,
                'winner' => $candidates->sortByDesc('count')->first()['name'],
            ];
        });

        return view('dashboard.dashboard', compact('organization_vote_list', 'organization_history_vote_list'));
    }

}
