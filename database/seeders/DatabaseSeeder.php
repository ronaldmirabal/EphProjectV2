<?php

namespace Database\Seeders;

use App\Models\TypeProduct;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypePeopleSeeder::class);
        $this->call(TypeProductSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UniversitySeed::class);
    }
}
