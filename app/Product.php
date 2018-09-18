<?php

namespace App;

use App\Color;
use App\Size;
use App\Traits\Product\HasPrice;
use App\Traits\Product\IsBuyable;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Buyable
{
    use IsBuyable, HasPrice;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the categories that own the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Scope a query to include related products only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeRelatedProducts($query, $attribute, $value, $number=8)
    {
        return $query->inRandomOrder()->get()->whereNotIn($attribute, $value)->take($number);
    }

    /**
     * Find the product by its attribute.
     *
     * @param  string $value
     * @param  string $attribute
     * @return \App\Product
     */
    public static function findBy($value, $attribute='slug')
    {
        $product = static::where($attribute, $value)->firstOrFail();

        return $product;
    }

    /**
     * Scope a query to include filtered products only.
     *
     * @param \App\Filters\Filters  $filters
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);  //App\Filters\Filters.php - apply(Builder $builder);
    }

    /**
     * Get the product variants that belong to product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

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
        $sizes_ids = $this->collectAttributeValues('size_id')->unique()->toArray();

        $sizes = Size::findMany($sizes_ids);

        return $sizes;
    }

    /**
     * Get the product colors.
     *
     * @return array
     */
    public function getColors()
    {
        $colors_ids = $this->collectAttributeValues('color_id')->unique()->toArray();

        $colors = Color::findMany($colors_ids);

        return $colors;
    }

    /**
     * A product has variants.
     *
     * @return boolean
     */
    public function hasVariants()
    {
        return $this->product_variants->count() > 0;
    }

    /**
     * Set the product's present_price attribute.
     *
     * @return string
     */
    public function getPresentPriceAttribute()
    {
        $prices = $this->collectAttributeValues('price');;

        if($prices)
        {
            $price = $this->hasVariablePrice($prices) ? 'ab '. $this->presentedPrices($prices->min())
                                                      : $this->presentedPrices($this->price);
        }
        else
        {
            $price = presentedPrices($this->price);
        }

        return $price;
    }

    /**
     * Fetch price and currency.
     *
     * @param  float $price
     * @return string
     */
    public function presentedPrices($price)
    {
        return presentCurrency() . $price;
    }

    /**
     * The product has a variable price depending on the variant.
     *
     * @param  collection  $prices
     * @return boolean
     */
    public function hasVariablePrice($prices)
    {
        $filtered = $prices->filter(function($price) {
                return $price != $this->price;
            });

        return $filtered->isNotEmpty();
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

    /**
     * Find a specific product variant by its attributes.
     *
     * @param  array $data
     * @return \App\ProductVariant
     */
    public function findVariant($data)
    {
        $variant = $this->product_variants
            ->where('product_id', $this->id)
            ->where('size_id', $data['size_id'])
            ->where('color_id', $data['color_id'])
            ->first();

        return $variant;
    }

    /**
     * Collect the variants-related attribute values.
     *
     * @param  string $attribute
     * @return collection
     */
    public function collectAttributeValues($attribute)
    {
        return $this->product_variants->pluck($attribute);
    }
}