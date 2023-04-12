<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

use App\Http\Controllers\LogController;


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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        // update tag
        $tag->update($request->validated());
        // redirect to tag index
        return redirect()->back()->with('success', 'Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        // delete tag
        $tag->delete();

        // redirect to tag index
        return redirect()->back()->with('success', 'Tag deleted successfully');
    }
}
