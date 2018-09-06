<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['women', 'man', 'kids', 'accesories'];

        foreach ($categories as $categoryName) {
            factory(App\Category::class)->create([
                'name' => $categoryName
            ]);
        }
    }
}
