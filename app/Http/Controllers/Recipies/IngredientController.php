<?php

namespace App\Http\Controllers\Recipies;

use App\Http\Controllers\Controller;
use App\Models\Grocery\Item;
use App\Models\Recipies\Recipie;
use App\Models\Recipies\RecipieIngredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Recipie $recipie)
    {
        return RecipieIngredient::recipie($recipie->id)->orderBy('sort', 'ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Recipie $recipie)
    {
        $last = RecipieIngredient::recipie($recipie->id)->orderBy('sort', 'DESC')->first();
        $nextSort = ($last ? $last->sort : 1);

        $item = Item::firstOrCreate(['name' => $request->name]);

        $ingredient = new RecipieIngredient;
        $ingredient->fill($request->all());
        $ingredient->item_id = $item->id;
        $ingredient->recipie_id = $recipie->id;
        $ingredient->sort = $nextSort;
        $ingredient->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipies\RecipieIngredient  $recipieIngredient
     * @return \Illuminate\Http\Response
     */
    public function show(RecipieIngredient $recipieIngredient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipies\RecipieIngredient  $recipieIngredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecipieIngredient $ingredient)
    {
        $ingredient->fill($request->all());
        $ingredient->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipies\RecipieIngredient  $recipieIngredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecipieIngredient $ingredient)
    {
        $ingredient->delete();
    }
}
