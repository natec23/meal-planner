<?php

namespace App\Http\Controllers\Recipies;

use App\Http\Controllers\Controller;
use App\Models\Recipies\RecipieCategory;
use App\Http\Requests\Recipies\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = RecipieCategory::all();

        return view('recipies.categories', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipies.category_edit', ['category' => false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        RecipieCategory::create($request->all());
        return redirect(route('recipie.category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipies\RecipieCategory  $recipieCategory
     * @return \Illuminate\Http\Response
     */
    public function show(RecipieCategory $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipies\RecipieCategory  $recipieCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(RecipieCategory $category)
    {
        return view('recipies.category_edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipies\RecipieCategory  $recipieCategory
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, RecipieCategory $category)
    {
        $category->fill($request->all())->save();
        return redirect(route('recipie.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipies\RecipieCategory  $recipieCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecipieCategory $category)
    {
        //
    }
}
