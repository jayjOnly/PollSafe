<?php

namespace App\Http\Controllers\voting;

use App\Http\Controllers\Controller;
use App\Http\Requests\voting\CreateVoteRequest;
use App\Http\Requests\voting\SetVoteRequest;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\OrganizationRole;
use App\Models\OrganizationVote;
use App\Models\OrganizationVoteCandidate;
use App\Models\OrganizationVoteMember;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Carbon\Carbon;

class VoteActionController extends Controller
{
    // request: name + description
    public function addVote(CreateVoteRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return back()->withErrors([
                'error' => $request->validator->errors()->first(),
            ])->withInput($request->all());
        }

        $validated = $request->validated();
        
        if (!isset($request->candidates) || !is_array($request->candidates) || count($request->candidates) < 2) {
            return back()->withErrors([
                'error' => 'Please select more than 1 candidates!',
            ])->withInput($request->all());
        }

        Organization::findOrFail($validated['organization_id']);
        
        $member = OrganizationMember::where('organization_id', $validated['organization_id'])
            ->where('user_id', Auth::id())
            ->first();

        if ($member->role_id !== OrganizationRole::ROLE_LEADER) {
            return abort(403, 'Forbidden');
        }

        $organizationVote = OrganizationVote::create([
            'organization_id' => $validated['organization_id'],
            'name' => $validated['voting_name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_time'],
            'end_date' => $validated['end_time'],
        ]);

        foreach ($request->candidates as $candidates) {
            OrganizationVoteCandidate::create([
                'organization_vote_id' => $organizationVote->id,
                'organization_member_id' => $candidates,
            ]);
        }

        return redirect(route('voting-active', ['organization_id' => $validated['organization_id']]));
    }

    public function setVote(SetVoteRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json(['message' => $request->validator->errors()->first()], 400);
        }

        $validated = $request->validated();

        $organization_vote = OrganizationVote::findOrFail($validated['organization_vote_id']);
        $organization_member = OrganizationMember::where('organization_id', $organization_vote->organization_id)->where('user_id', Auth::id())->first();

        if (OrganizationVoteMember::where('organization_member_id', $organization_member->id)->where('organization_vote_id', $validated['organization_vote_id'])->exists()) {
            return response()->json(['message' => 'Already voted!'], 429);
        }

        $currentTime = Carbon::now();

        if ($currentTime->lt($organization_vote->start_date)) {
            return response()->json(['message' => 'Voting has not started yet!'], 403);
        }
    
        if ($currentTime->gt($organization_vote->end_date)) {
            return response()->json(['message' => 'Voting period has ended!'], 403);
        }

        OrganizationVoteMember::create([
            'organization_vote_id' => $validated['organization_vote_id'],
            'organization_member_id' => $organization_member->id,
            'organization_vote_candidate_id' => $validated['candidate_id'],
        ]);

        return response()->json(['message' => 'Success'], 200);
    }
}
