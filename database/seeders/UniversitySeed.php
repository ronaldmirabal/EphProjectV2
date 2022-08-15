<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Seeder;


class UniversitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        University::create([
            'name'=> 'Recinto Emilio Prud`Homme',
            'address'=> 'Santiago',
            'email'=> 'eph@isfodosu.edu.do',
            'phone'=> '809-857-8695',
        ]);
    }
}
