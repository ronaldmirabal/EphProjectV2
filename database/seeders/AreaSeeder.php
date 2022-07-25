<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;
class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create(['name'=> 'Contabilidad']);
        Area::create(['name'=> 'Administración']);
        Area::create(['name'=> 'Dirección Académica']);
        Area::create(['name'=> 'Biblioteca']);
    }
}
