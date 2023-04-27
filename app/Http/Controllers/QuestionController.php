<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Question;
use App\Models\ReportType;
use Illuminate\Support\Str;
use App\Http\Controllers\LogController;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(8);
        // dd($questions);
        return view('questions.index', compact('questions'));
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
        if (auth()->user()->hasPermissionTo('create questions')) {
            $log = new LogController();

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
            $log->logMe("info", "Created question ID: $question->id", "POST", request()->ip());
            return redirect()->back();
        } else {
            session()->flash('success', 'You are not allowed to create questions');
            session()->flash('icon', 'error');
            $log->logMe("info", "Unauthorized attempt to create question", "POST", request()->ip());

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $slug)
    {

        $question = Question::where('slug', $slug)->firstOrFail();
        $reportTypes = ReportType::all();
        return view('questions.show', compact('question', 'reportTypes'));
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
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('delete questions')) {
                $log = new LogController();
                $question = Question::find($id);
                $question->delete();

                $log->logMe("info", "Deleted question ID: $question->id", "DELETE", request()->ip());
                session()->flash('success', 'Question deleted successfully');
                session()->flash('icon', 'success');
                return redirect()->back();
            } else {
                session()->flash('success', 'You are not allowed to delete questions');
                session()->flash('icon', 'error');

                $log->logMe("info", "Unauthorized attempt to delete question", "DELETE", request()->ip());
                return redirect()->back();
            }
        } else {
            $log->logMe("error", "Failed of deleted question ID: $question->id, not logged", "DELETE", request()->ip());

            session()->flash('success', 'You must be logged in to delete questions');
            session()->flash('icon', 'error');
            return redirect()->back();
        }
    }
}
