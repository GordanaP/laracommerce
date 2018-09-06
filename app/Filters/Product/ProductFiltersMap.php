<?php

namespace App\Filters\Product;

use App\Category;
use App\Filters\Filters;


class ProductFiltersMap extends Filters
{
    public static function mappings()
    {
        return [
            'category' => Category::all()->pluck('slug', 'name'),
            'price' => [
                'High to Low' => 'high_low',
                'Low to High' => 'low_high',
            ],
        ];
    }
}