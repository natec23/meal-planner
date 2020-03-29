<?php

namespace App\Models\Grocery;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['category_id', 'color', 'emoji', 'name'];
}
