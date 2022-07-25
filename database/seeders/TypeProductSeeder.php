<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeProduct;
class TypeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeProduct::create(['name'=> 'Laptop']);
        TypeProduct::create(['name'=> 'CPU']);
        TypeProduct::create(['name'=> 'Monitor']);
        TypeProduct::create(['name'=> 'Servidor']);
        TypeProduct::create(['name'=> 'Switch']);
    }
}
