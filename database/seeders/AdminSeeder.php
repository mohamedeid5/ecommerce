<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * create admin.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
           'name' => 'Mohamed eid',
           'email' => 'meid368@gmail.com',
           'password' => bcrypt('mohamedeid'),
        ]);
    }
}
