<?php

namespace App\ViewComposers;

use App\Filters\Product\ProductFiltersMap;
use Illuminate\View\View;

class ProductFiltersComposer
{
    public function compose(View $view)
    {
        $view->with([
            'mappings' => ProductFiltersMap::mappings(),
        ]);
    }
}