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
    }
}
