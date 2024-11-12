<?php

namespace App\Http\Controllers\voting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class VotingPageController extends Controller
{
    public function show() {
        return view('voting.votingPage');
    }

    public function index()
    {
        $candidates = [
            // Array of candidate objects
            [
                'id' => 1,
                'name' => 'Jane Doe',
                'image' => 'JV.png'
            ],
            [
                'id' => 2,
                'name' => 'John Smith',
                'image' => 'JV.png'
            ],
            [
                'id' => 3,
                'name' => 'Tom Sanders',
                'image' => 'JV.png'
            ],
            // More candidates...
        ];

        return view('voting.votingPage', compact('candidates'));
    }

    public function vote(Request $request)
    {
        $validatedData = $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);
        // Logic to save the vote goes here
        
        return response()->json(['message' => 'Vote recorded successfully']);
    }
}


