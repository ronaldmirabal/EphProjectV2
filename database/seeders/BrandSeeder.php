<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create(['name'=> 'DELL']);
        Brand::create(['name'=> 'HP']);
        Brand::create(['name'=> 'LENOVO']);
        Brand::create(['name'=> 'ACER']);
        Brand::create(['name'=> 'ASUS']);
        Brand::create(['name'=> 'SAMSUNG']);
        Brand::create(['name'=> 'TOSHIBA']);
        Brand::create(['name'=> 'SONY']);
    }
}
