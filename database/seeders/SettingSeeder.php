<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'default_locale' => 'en',
            'default_timezone' => 'Africa/Cairo',
            'reviews_enable' => true,
            'auto_approve_reviews' => true,
            'supported_currencies' => ['USD', 'EGP'],
            'default_currency' => ['USD'],
            'store_email' => 'contact@store.com',
            'search_engine' => 'mysql',
            'outer_shipping_cost' => 0,
            'free_shipping_cost' => 0,
            'local_shipping_cost' => 0,
            'translatable' => [
                'store_name' => 'Book Shop',
                'free_shipping_label' => 'Free Shipping',
                'local_label' => 'Local Shipping',
                'outer_label' => 'Outer Shipping',
            ]
        ]);
    }
}
