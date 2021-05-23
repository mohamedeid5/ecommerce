<?php

namespace Database\Seeders;

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
        $this->call(SettingSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CategoryDatabaseSeeder::class);
        $this->call(BrandDatabaseSeeder::class);
        $this->call(ProductDatabaseSeeder::class);
    }
}
