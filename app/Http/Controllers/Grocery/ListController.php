<?php

namespace App\Http\Controllers\Grocery;

use App\Http\Controllers\Controller;
use App\Models\Grocery\GroceryList;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = GroceryList::where('default_list', 1)->get()->first();
        return redirect(url('list', $list));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroceryList  $groceryList
     * @return \Illuminate\Http\Response
     */
    public function show(GroceryList $list)
    {
        return view('grocery.list', ['list' => $list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroceryList  $groceryList
     * @return \Illuminate\Http\Response
     */
    public function edit(GroceryList $groceryList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroceryList  $groceryList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroceryList $groceryList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroceryList  $groceryList
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroceryList $groceryList)
    {
        //
    }
}
