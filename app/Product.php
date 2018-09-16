<?php

namespace App;

use App\Color;
use App\Observers\ProductObserver;
use App\Size;
use App\Traits\Product\IsBuyable;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Buyable
{
    use IsBuyable;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // public function sizes()
    // {
    //     return $this->belongsToMany(Size::class)->as('feature')->withPivot('color_id');
    // }

    /**
     * Set the product price.
     *
     * @param  int  $value
     * @return number
     */
    public function getPriceAttribute($value, $decimals = 2)
    {
        $price = $value/100;

        $price_formatted = number_format($price, $decimals);

        return $price_formatted;
    }

    /**
     * Set the product price and currency.
     *
     * @return string
     */
    public function getPresentPriceAttribute()
    {
        $price = $this->price;

        $currency = config('app.currency');

        return $currency.$price;
    }

    /**
     * Scope a query to only include related products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeRelatedProducts($query, $attribute, $value, $number=8)
    {
        return $query->inRandomOrder()->get()->whereNotIn($attribute, $value)->take($number);
    }

    public static function findBy($value, $attribute='slug')
    {
        $product = static::where($attribute, $value)->firstOrFail();

        return $product;
    }

    /**
     * Scope a query to only include filtered products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);  //App\Filters\Filters.php - apply(Builder $builder);
    }

    // /**
    //  * The product has sizes.
    //  *
    //  * @return boolean [description]
    //  */
    // public function hasSizes()
    // {
    //     $sizes = $this->sizes->unique();

    //     return $sizes->isNotEmpty();
    // }

    // public function hasColors()
    // {
    //     $colors = [];

    //     if($this->hasSizes())
    //     {
    //         foreach ($this->sizes as $size)
    //         {
    //             array_push($colors, $size);
    //         }
    //     }

    //     return sizeof($colors) > 0;
    // }

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Get the product sizes.
     *
     * @return array
     */
    public function getSizes()
    {
        $sizes_ids = $this->product_variants->pluck('size_id')->unique()->toArray();

        $sizes = Size::findMAny($sizes_ids);

        return $sizes;
    }

    /**
     * Get the product colors.
     *
     * @return array
     */
    public function getColors()
    {
        $colors_ids = $this->product_variants->pluck('color_id')->unique()->toArray();

        $colors = Color::findMAny($colors_ids);

        return $colors;
    }

    /**
     * A product has a specific variant.
     *
     * @param  array  $data
     * @return boolean
     */
    public function hasVariants()
    {
        return $this->product_variants->count() > 0;
    }

    public function getVariant()
    {
        $productVariant = $this->product_variants
            ->where('size_id', request()->size_id)
            ->where('color_id', request()->color_id)
            ->first();

        return $productVariant;
    }

    /**
     * The product has sizes.
     *
     * @return boolean
     */
    public function hasSizes()
    {
        $sizes = $this->product_variants->where('size_id', '!==', null);

        return $sizes->isNotEmpty();
    }

    /**
     * The product has colors.
     *
     * @return boolean
     */
    public function hasColors()
    {
        $colors = $this->product_variants->where('color_id', '!==', null);

        return $colors->isNotEmpty();
    }

    public function findVariant($data)
    {
        $variant = $this->product_variants
            ->where('product_id', $this->id)
            ->where('size_id', $data['size_id'])
            ->where('color_id', $data['color_id'])
            ->first();

        return $variant;
    }
}