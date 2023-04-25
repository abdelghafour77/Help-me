<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Question;
use Illuminate\Support\Str;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $question = Question::with('answers')->findOrFail(1);
        dd($question);
        return view('questions.index', compact('question'));
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
        $request->merge(['slug' => Str::slug($request->input('title'))]);
        // dd($request->all());
        $question = Question::create($request->all());

        $tags = json_decode($request->input('tags'));
        $tags = collect($tags);
        $tags = $tags->pluck('id')->toArray();
        $question->tags()->attach($tags);
        session()->flash('success', 'Question created successfully');
        session()->flash('icon', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(String $slug)
    {
        $question = Question::where('slug', $slug)->firstOrFail();
        return view('questions.show', compact('question'));
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
    public function destroy(string $id)
    {

        $question = Question::find($id);
        $question->delete();
        session()->flash('success', 'Question deleted successfully');
        session()->flash('icon', 'success');
        return redirect()->back();
    }
}
