<?php

namespace App\Observers;

use App\Category;

class CategoryObserver
{
    /**
     * Listen to the Category creating event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        $category->slug = str_slug($category->name);
    }
}