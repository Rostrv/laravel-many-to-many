<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciccios = Category::all();
        /* $categories = Category::all(); */
        return view('admin.categories.index', compact('ciccios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val_data = $request->validate([
            'name' => 'required|unique:categories'
        ]);
        // generate slug
        $slug = Str::slug($request->name);
        $val_data['slug'] = $slug;

        // salvare

        Category::create($val_data);

        // redirect
        return redirect()->back()->with('message', "Category $slug added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $val_data = $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore($category)]
        ]);
        // generate slug
        $slug = Str::slug($request->name);
        $val_data['slug'] = $slug;

        $category->update($val_data);
        return redirect()->back()->with('message', "Category $slug updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('message', "Category $category->name removed successfully");
    }
}
