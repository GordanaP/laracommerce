<?php

use App\Color;
use App\Product;
use App\Size;
use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Color', 10)->create();

        $products1 = Product::whereIn('id', [1,2,3,4,5])->get()->pluck('id')->toArray();
        $products2 = Product::whereIn('id', [1,3,5,7,8,9,10])->get()->pluck('id')->toArray();
        $products3 = Product::whereIn('id', [11,12,13,14,15])->get()->pluck('id')->toArray();

        Color::first()->products()->attach($products1);
        Color::find(2)->products()->attach($products2);
        Color::find(3)->products()->attach($products3);
        Color::find(4)->products()->attach($products1);
        Color::find(5)->products()->attach($products2);
    }
}
