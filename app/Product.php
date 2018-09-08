<?php

namespace App;

use App\Observers\ProductObserver;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Buyable
{

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

    public function sizes()
    {
        return $this->belongsToMany(Size::class)->as('feature')->withPivot('color_id');
    }

    /**
     * Set the product price.
     *
     * @param  int  $value
     * @return number
     */
    public function getPriceAttribute($value)
    {
        $price = $value/100;

        $price_formatted = number_format($price, 2);

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

    public function getBuyableIdentifier($options = null){
        return $this->id;
    }

    public function getBuyableDescription($options = null){
        return $this->name;
    }

    public function getBuyablePrice($options = null){
        return $this->price;
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
}
