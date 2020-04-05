<?php

namespace App\Http\Controllers\Recipies;

use App\Http\Controllers\Controller;
use App\Models\Grocery\Item;
use App\Models\Recipies\Recipie;
use App\Models\Recipies\RecipieDirection;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Recipie $recipie)
    {
        return RecipieDirection::recipie($recipie->id)->orderBy('sort', 'ASC')->get();
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
    public function store(Request $request, Recipie $recipie)
    {
        $last = RecipieDirection::recipie($recipie->id)->orderBy('sort', 'DESC')->first();
        $nextSort = ($last ? $last->sort : 1);

        $direction = new RecipieDirection;
        $direction->fill($request->all());
        $direction->recipie_id = $recipie->id;
        $direction->sort = $nextSort;
        $direction->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipies\RecipieDirection  $recipieDirection
     * @return \Illuminate\Http\Response
     */
    public function show(RecipieDirection $recipieDirection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipies\RecipieDirection  $recipieDirection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecipieDirection $direction)
    {
        $direction->fill($request->all());
        $direction->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipies\RecipieDirection  $recipieDirection
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecipieDirection $direction)
    {
        $direction->delete();
    }
}
