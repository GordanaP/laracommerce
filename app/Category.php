<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get the products that belong to the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Set the category name attribute.
     *
     * @return string.
     */
    public function getFormattedNameAttribute()
    {
        return ucfirst($this->name);
    }
}
