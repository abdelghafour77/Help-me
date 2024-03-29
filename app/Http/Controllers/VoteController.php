<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\LogController;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
// use spatie permission


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
        // check if user is logged in
        if (auth()->user()) {
            // if user has permission to vote
            if (auth()->user()->hasPermissionTo('vote')) {
                $log = new LogController();
                $user_id = auth()->user()->id;
                if ($request->is_upvote == -1) {
                    $vote = Vote::where('user_id', $user_id)->where('answer_id', $request->answer_id)->delete();
                    $type = 'none';
                    $log->logMe("info", "Delete vote ID: $vote->id", "POST", $request->ip());

                    // Answer::where('id', $request->answer_id)->decrement('votes_count');
                } else {
                    $vote = Vote::where('user_id', $user_id)->where('answer_id', $request->answer_id)->first();
                    if ($vote) {
                        $vote->update([
                            'is_upvote' => $request->is_upvote
                        ]);
                        $log->logMe("info", "Updated vote ID: $vote->id", "POST", $request->ip());
                    } else {
                        $vote = Vote::create([
                            'user_id' => $user_id,
                            'answer_id' => $request->answer_id,
                            'is_upvote' => $request->is_upvote,
                        ]);
                        $log->logMe("info", "Created vote ID: $vote->id", "POST", $request->ip());
                    }
                    $type = ($request->is_upvote == 1) ? 'up' : 'down';
                }

                return response()->json([
                    'message' => 'Vote successfully',
                    'icon' => 'success',
                    'type' => $type,
                    'upvote' => Vote::where('answer_id', $request->answer_id)->where('is_upvote', 1)->count(),
                    'downvote' => Vote::where('answer_id', $request->answer_id)->where('is_upvote', 0)->count(),
                ], 200);
            } else {
                return response()->json([
                    'message' => 'You do not have permission to vote',
                    'icon' => 'error',
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'You must login to vote',
                'icon' => 'error',
            ], 401);
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
