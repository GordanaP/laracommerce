<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 15)->create();

        $products_1 = Product::take(5)->get();
        $category_1 = Category::first();

        $products_2 = Product::take(5)->get();
        $category_2 = Category::find(2);

        $products_3 = Product::take(5)->get();
        $category_3 = Category::find(3);

        foreach ($products_1 as $product) {
            $product->categories()->attach($category_1);
        }

        foreach ($products_2 as $product) {
            $product->categories()->attach($category_2);
        }

        foreach ($products_3 as $product) {
            $product->categories()->attach($category_3);
        }
    }
}
