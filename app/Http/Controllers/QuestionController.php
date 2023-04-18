<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionController extends Controller
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
        // get all tags
        $tags = Tag::all();

        return view('questions.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $request->all();
        $request->merge(['user_id' => auth()->user()->id]);
        $question = Question::create($request->all());

        $tags = json_decode($request->input('tags'));
        $tags = collect($tags);
        $tags = $tags->pluck('id')->toArray();
        $question->tags()->attach($tags);
        return redirect()->back()->with('success', 'Question created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
