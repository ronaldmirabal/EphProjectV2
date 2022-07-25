<?php

namespace Database\Seeders;
use App\Models\TypePeople;
use Illuminate\Database\Seeder;

class TypePeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypePeople::create(['name'=> 'Empleado']);
        TypePeople::create(['name'=> 'Docente']);
    }
}
