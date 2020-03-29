<?php

namespace App\Http\Controllers\Grocery;

use App\Http\Controllers\Controller;
use App\Models\Grocery\GroceryList;
use App\Models\Grocery\Item;
use Illuminate\Http\Request;

class ListItemController extends Controller
{
    public function items(GroceryList $list)
    {
        $items = $list->items;
        $categoryItems = $items->groupBy('category_id');
        return $categoryItems;
    }

    public function update(Request $request, GroceryList $list, Item $item)
    {
        $validatedData = $request->validate([
            'qty' => 'numeric',
            'unit' => 'max:250',
            'notes' => ''
        ]);
        $list->items()->syncWithoutDetaching([$item->id => $validatedData]);
    }

    public function destroy(GroceryList $list, Item $item)
    {
        $list->items()->detach($item);
    }
}
