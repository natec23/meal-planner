<?php

namespace App\Http\Controllers\Grocery;

use App\Http\Controllers\Controller;
use App\Models\Grocery\GroceryList;
use App\Models\Grocery\Item;
use Auth;
use DB;
use Illuminate\Http\Request;

class ListItemController extends Controller
{
    public function items(GroceryList $list)
    {
        $items = $list->items;
        $categoryItems = $items->groupBy('category_id');
        return $categoryItems;
    }

    public function destroy(GroceryList $list, Item $item)
    {
        $list->items()->detach($item);
    }
}
