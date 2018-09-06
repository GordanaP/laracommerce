<?php

namespace App\Filters\Product;

use App\Category;
use App\Filters\Filters;

class ProductFilters extends Filters
{
    /**
     * Filter name.
     *
     * @var array
     */
    protected $filters = ['category', 'price'];

    /**
     * Sort products by category.
     *
     * @param  string $slug
     * @return array
     */
    protected function category($slug) //$slug = request()->category
    {
        $category = Category::whereSlug($slug)->first();

        if($category)
        {
            return $this->builder->whereHas('categories', function($query) use($slug) {
                $query->where('slug', $slug);
            });
        }
    }

    /**
     * Sort products by price order.
     *
     * @param  string $order
     * @return array
     */
    public function price($order)
    {
        $orders = ['low_high', 'high_low'];

        if (in_array($order, $orders))
        {
            if($order === $orders[0])
            {
                return $this->builder->orderBy('price', 'asc');
            }
            elseif ($order === $orders[1])
            {
                return $this->builder->orderBy('price', 'desc');
            }
        }
    }
}