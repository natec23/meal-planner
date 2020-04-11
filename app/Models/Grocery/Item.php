<?php

namespace App\Models\Grocery;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['category_id', 'color', 'emoji', 'name'];

    public function ingredients()
    {
        return $this->hasMany('App\Models\Recipies\RecipieIngredient');
    }

    public function lists()
    {
        return $this->belongsToMany('App\Models\Grocery\GroceryList');
    }
}
