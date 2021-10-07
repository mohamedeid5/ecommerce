<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $categories = $this->getAllCategories();

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $categories = Category::parent()->orderBy('id', 'DESC')->get();

        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {

        DB::transaction(function () use ($request){

            $category = Category::create($request->validated());

            $category->name = $request->name;

            $category->save();
        });

        return redirect()->route('admin.categories.index')->with(['success' => 'category added successfuly']);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(Category $category)
    {
        $categories = Category::latest()->get();

        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {

        DB::transaction(function () use ($request, $id){

            $category = $this->getCategoryById($id);

            $category->update($request->validated());

            $category->name = $request->name;

            $category->save();

        });

        return back()->with(['success'=>'category updated successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = $this->getCategoryById($id);

        $category->delete();

        return redirect()->route('admin.categories.index')->with(['success'=>'category deleted successfuly']);
    }

    /**
     * return category id
     *
     * @param int $id
     *
     * @return object
     */
    private function getCategoryById($id)
    {
        return Category::find($id);
    }

    private function getAllCategories()
    {
        return Category::parent()->latest()->paginate(PAGINATION_NUMBER);
    }
}
