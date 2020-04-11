<?php

namespace App\Models\Recipies;

use Illuminate\Database\Eloquent\Model;

class RecipieIngredient extends Model
{
    protected $with = ['item'];

    protected $fillable = ['amount', 'unit', 'notes', 'optional'];

    public function scopeRecipie($query, $recipie_id) {
        return $query->where('recipie_id', $recipie_id);
    }

    public function item()
    {
        return $this->hasOne('App\Models\Grocery\Item', 'id', 'item_id');
    }
}
