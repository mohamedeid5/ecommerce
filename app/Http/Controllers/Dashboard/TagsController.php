<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagsRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
       $tags =  Tag::latest()->paginate(PAGINATION_NUMBER);

        return view('dashboard.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('dashboard.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagsRequest $request)
    {
        Tag::create($request->validated());

        return redirect()->route('admin.tags.index')->with(['success'=>'tag added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return int
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Method edit
     *
     * @param Tag $tag
     *
     * @return void
     */
    public function edit(Tag $tag)
    {
        return view('dashboard.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TagsRequest $request, $id)
    {
        $tag = Tag::find($id);

        $tag->name = $request->name;

        $tag->save();

        return redirect()->back()->with(['success'=>'tag updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Tag::find($id)->delete();

        return back()->with(['success'=>'tag deleted successfully']);

    }
}
