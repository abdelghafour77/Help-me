<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // create function to store vote in database that will be called from ajax using method post
    public function vote(Request $request)
    {
        $user_id = auth()->user()->id;
        if ($request->is_upvote == -1) {
            Vote::where('user_id', $user_id)->where('answer_id', $request->answer_id)->delete();
            Answer::where('id', $request->answer_id)->decrement('votes_count');
        } else {
            $vote = Vote::where('user_id', $user_id)->where('answer_id', $request->answer_id)->first();
            if ($vote) {
                $vote->update([
                    'is_upvote' => $request->is_upvote
                ]);
            } else {
                Vote::create([
                    'user_id' => $user_id,
                    'answer_id' => $request->answer_id,
                    'is_upvote' => $request->is_upvote,
                ]);
            }
        }
        return response()->json([
            'success' => 'Vote successfully'

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoteRequest $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
