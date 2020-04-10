<?php

namespace App\Http\Controllers\Recipies;

use App\Http\Controllers\Controller;
use App\Models\Grocery\Item;
use App\Models\Recipies\Recipie;
use App\Models\Recipies\RecipieIngredient;
use App\Http\Requests\Recipies\IngredientRequest;

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
    public function store(IngredientRequest $request, Recipie $recipie)
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
    public function show(RecipieIngredient $ingredient)
    {
        return $ingredient;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipies\RecipieIngredient  $recipieIngredient
     * @return \Illuminate\Http\Response
     */
    public function update(IngredientRequest $request, RecipieIngredient $ingredient)
    {
        // grab new item if name has changed
        if($ingredient->item->name != $request->name) {
            $old_item_id = $ingredient->item->id;
            $item = Item::firstOrCreate(['name' => $request->name]);
            $ingredient->item_id = $item->id;
        }

        $ingredient->fill($request->all());
        $ingredient->save();

        // delete the old item if it's not associated with anything else
        if(isset($old_item_id)) {
            $item = Item::where('id', $old_item_id)->withCount(['ingredients', 'lists'])->get()->first();
            if($item->lists_count == 0 && $item->ingredients_count == 0) {
                $item->delete();
            }
        }
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
