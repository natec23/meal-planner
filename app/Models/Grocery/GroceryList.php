<?php

namespace App\Models\Grocery;

use Illuminate\Database\Eloquent\Model;

class GroceryList extends Model
{
    public function items()
    {
        return $this->belongsToMany('App\Models\Grocery\Item')->withTimestamps()->withPivot(['unit', 'notes', 'qty']);
    }
}
