<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public function products()
    {
        return $this->morphToMany(Product::class, 'productable'); //belongsToMany
    }
}
