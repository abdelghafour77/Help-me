<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTagRequest;

use App\Http\Controllers\LogController;
use App\Http\Requests\UpdateTagRequest;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('view tags')) {
                // get all tags
                $tags = Tag::all();
                $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " viewed tags", "GET", request()->ip());
                // return view
                return view('tags', compact('tags'));
            } else {
                $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to view tags", "GET", request()->ip());
                session()->flash('message', 'You are not allowed to view tags');
                session()->flash('icon', 'error');
                return redirect()->back();
            }
        } else {
            $log->logMe("warning", "Guest tried to view tags", "GET", request()->ip());
            session()->flash('message', 'You must be logged in to view tags');
            session()->flash('icon', 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // get all question that have this tag slug
    public function getTagQuestions(string $slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        $questions = $tag->questions()->paginate(10);
        return view('tag', compact('tag', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('create tags')) {


                $tag = $request->validated();

                $tag['slug'] = Str::slug($tag['name']);

                $ta = Tag::create($tag);

                $log->logMe("info", "Created tag ID: $ta->id", "POST", $request->ip());

                session()->flash('message', 'Tag created successfully');
                session()->flash('icon', 'success');

                return redirect()->back();
            } else {
                $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to create tag", "POST", request()->ip());
                session()->flash('message', 'You are not allowed to create tags');
                session()->flash('icon', 'error');
                return redirect()->back();
            }
        } else {
            $log->logMe("warning", "Guest tried to create tag", "POST", request()->ip());
            session()->flash('message', 'You must be logged in to create tags');
            session()->flash('icon', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        // show tag
        return view('tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('view tags')) {
                $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " viewed tag ID: $id", "GET", request()->ip());
                $tag = Tag::find($id);
                // return ajax response with tag data
                return response()->json(
                    $tag
                );
            } else {
                $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to view tag ID: $id", "GET", request()->ip());
                session()->flash('message', 'You are not allowed to view tags');
                session()->flash('icon', 'error');
                return redirect()->back();
            }
        } else {
            $log->logMe("warning", "Guest tried to view tag ID: $id", "GET", request()->ip());
            session()->flash('message', 'You must be logged in to view tags');
            session()->flash('icon', 'error');
            return redirect()->back();
        }
    }

    public function allTags()
    {
        $tags = Tag::all();
        return response()->json(
            $tags
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('edit tags')) {
                $log->logMe("info", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " updated tag ID: $tag->id", "PUT", $request->ip());
                // update tag
                $tag->update($request->validated());
                $ta = Tag::find($tag->id);
                $log = new LogController();
                $log->logMe("info", "Updated tag ID: $ta->id", "PUT", $request->ip());
                // redirect to tag index
                session()->flash('message', 'Tag updated successfully');
                session()->flash('icon', 'success');
                return redirect()->back();
            } else {
                $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to update tag ID: $tag->id", "PUT", $request->ip());
                session()->flash('message', 'You are not allowed to update tags');
                session()->flash('icon', 'error');
                return redirect()->back();
            }
        } else {
            $log->logMe("warning", "Guest tried to update tag ID: $tag->id", "PUT", $request->ip());
            session()->flash('message', 'You must be logged in to update tags');
            session()->flash('icon', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag, Request $request)
    {
        $log = new LogController();
        if (auth()->user()) {
            if (auth()->user()->hasPermissionTo('delete tags')) {
                // delete tag
                $tag->delete();

                $log->logMe("warning", "Deleted tag ID: $tag->id", "DELETE", $request->ip());
                session()->flash('message', 'Tag deleted successfully');
                session()->flash('icon', 'success');
                // redirect to tag index
                return redirect()->back();
            } else {
                $log->logMe("warning", "User ID: " . auth()->user()->id . " - " . auth()->user()->name . " tried to delete tag ID: $tag->id", "DELETE", $request->ip());
                session()->flash('message', 'You are not allowed to delete tags');
                session()->flash('icon', 'error');
                return redirect()->back();
            }
        } else {
            $log->logMe("warning", "Guest tried to delete tag ID: $tag->id", "DELETE", $request->ip());
            session()->flash('message', 'You must be logged in to delete tags');
            session()->flash('icon', 'error');
            return redirect()->back();
        }
    }
}
