<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class CreateBrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents('database/json_data/car-models.json'));

        // iterate all items from json file
        foreach ($data as $item) {
            // save brand to db
            $brand = Brand::create([
                'brand' => $item->brand
            ]);

            // iterate all models for each brand and save them to db
            foreach ($item->models as $model) {
                $brand->car_models()->create([
                    'car_model' => $model
                ]);
            }
        }
    }
}
