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
        // get all tags
        $tags = Tag::all();
        // return view
        return view('tags', compact('tags'));
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
    public function store(StoreTagRequest $request)
    {
        $log = new LogController();

        $tag = $request->validated();

        $tag['slug'] = Str::slug($tag['name']);

        $ta = Tag::create($tag);

        $log->logMe("info", "Created tag ID: $ta->id", "POST", $request->ip());

        session()->flash('message', 'Tag created successfully');
        session()->flash('icon', 'success');

        return redirect()->back();
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
        $tag = Tag::find($id);
        // return ajax response with tag data
        return response()->json(
            $tag
        );
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
        // update tag
        $tag->update($request->validated());
        $ta = Tag::find($tag->id);
        $log = new LogController();
        $log->logMe("info", "Updated tag ID: $ta->id", "PUT", $request->ip());
        // redirect to tag index
        session()->flash('message', 'Tag updated successfully');
        session()->flash('icon', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag, Request $request)
    {
        // delete tag
        $tag->delete();

        $log = new LogController();

        $log->logMe("warning", "Deleted tag ID: $tag->id", "DELETE", $request->ip());
        session()->flash('message', 'Tag deleted successfully');
        session()->flash('icon', 'success');
        // redirect to tag index
        return redirect()->back();
    }
}
