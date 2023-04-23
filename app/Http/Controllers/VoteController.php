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
        // dd($request->all());
        // check if user is logged in
        if (auth()->check()) {
            // check if user has already voted
            $vote = Vote::where('user_id', auth()->user()->id)->where('answer_id', $request->answer_id)->first();
            // if user has not voted
            if (!$vote) {
                // create new vote
                Vote::create([
                    'user_id' => auth()->user()->id,
                    'answer_id' => $request->answer_id,
                    'is_upvote' => $request->is_upvote
                ]);
            } else {
                // if user has already voted, update vote
                $vote->update([
                    'is_upvote' => $request->is_upvote
                ]);
            }
            // get answer
            $answer = Answer::find($request->answer_id);
            // return json response
            return response()->json([
                'message' => 'success',
                'votesCount' => $answer->votes()->sum('is_upvote')
            ]);
        } else {
            // if user is not logged in, return json response
            return response()->json([
                'message' => 'Unauthenticated.'
            ]);
        }
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
