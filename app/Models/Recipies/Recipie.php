<?php

namespace App\Models\Recipies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipie extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'notes', 'prep_time', 'cook_time', 'oven_temp', 'yield', 'yield_unit', 'origin'];
    protected $with = ['directions', 'ingredients'];

    public function directions()
    {
        return $this->hasMany('App\Models\Recipies\RecipieDirection');
    }

    public function ingredients()
    {
        return $this->hasMany('App\Models\Recipies\RecipieIngredient');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Recipies\Tag');
    }
}
