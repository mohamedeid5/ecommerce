<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OptionsRequest;
use App\Models\Option;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::latest()->paginate(PAGINATION_NUMBER);

        return view('dashboard.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        $data['products'] = Product::active()->select('id')->get();

        $data['variations'] = Variation::active()->select('id')->get();

        return view('dashboard.options.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionsRequest $request)
    {
       $option = Option::create($request->validated());

       $option->name = $request->name;

       $option->save();

       return redirect()->route('admin.options.index');
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
     * @param Option $option
     *
     * @return void
     */
    public function edit(Option $option)
    {

        $data = [];

        $data['products'] = Product::active()->select('id')->get();

        $data['variations'] = Variation::active()->select('id')->get();

        return view('dashboard.options.edit', compact('option', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OptionsRequest $request, $id)
    {
        $option = Option::find($id);

        $option->update($request->validated());

        $option->name = $request->name;

        $option->save();

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
