<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variation;
use App\Http\Requests\Admin\VariationsRequest;

class VariationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variations = Variation::latest()->paginate(PAGINATION_NUMBER);

        return view('dashboard.variations.index', compact('variations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.variations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VariationsRequest $request)
    {

        $variations = Variation::create($request->validated());

        $variations->name = $request->name;

        $variations->save();

        return redirect()->route('admin.variations.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Method edit
     *
     * @param Variation $variation
     *
     * @return void
     */
    public function edit(Variation $variation)
    {
        return view('dashboard.variations.edit', compact('variation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VariationsRequest $request, $id)
    {

        $variation = Variation::find($id);

        $variation->name = $request->name;

        $variation->is_active = $request->is_active;

        $variation->save();

        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
