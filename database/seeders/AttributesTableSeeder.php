<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Attribute;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<50; $i++){
            $product = Product::factory()->create();
            $attributes = Attribute::factory()
                            ->count(5)
                            ->for($product)
                            ->create();
        }
    }
}
