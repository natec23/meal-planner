<?php

namespace App\Models\Recipies;

use Illuminate\Database\Eloquent\Model;

class RecipieDirection extends Model
{
    protected $fillable = ['heading', 'details'];

    public function scopeRecipie($query, $recipie_id) {
        return $query->where('recipie_id', $recipie_id);
    }
}
