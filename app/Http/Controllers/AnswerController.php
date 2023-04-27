<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Http\Controllers\LogController;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreAnswerRequest $request)
    {
        if (auth()->user()->hasPermissionTo('create answers')) {
            // validate and create answer
            $answer = $request->validated();
            $answer['user_id'] = auth()->id();
            $answer = Answer::create($answer);
            // session message icon and title
            session()->flash('message', 'Answer created successfully');
            session()->flash('icon', 'success');
            $log = new LogController();
            $log->logMe("info", "Created answer ID: $answer->id", "POST", $request->ip());


            return back();
        } else {
            // session message icon and title
            session()->flash('message', 'You do not have permission to create an answer');
            session()->flash('icon', 'error');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->hasPermissionTo('delete answers')) {


            // find answer
            $answer = Answer::findOrFail($id);
            // check if user is authorized
            if ($answer->user_id == auth()->id()) {
                // delete answer
                $answer->delete();
                // session message icon and title
                session()->flash('message', 'Answer deleted successfully');
                session()->flash('icon', 'success');
            } else {
                // session message icon and title
                session()->flash('message', 'You do not have permission to delete this answer');
                session()->flash('icon', 'error');
            }
            $log = new LogController();
            $log->logMe("info", "Deleted answer ID: $answer->id", "DELETE", request()->ip());

            return back();
        } else {
            // session message icon and title
            session()->flash('message', 'You do not have permission to delete an answer');
            session()->flash('icon', 'error');
            return back();
        }
    }
}
