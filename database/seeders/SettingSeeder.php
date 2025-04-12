<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Setting::count() === 0) {
        $setting = [
            [
                'country_id'=>"1",
                'key' => "facebook",
                'value' => "https://www.facebook.com/sharer"
            ],
            [
                'country_id'=>"1",
                'key' => "twitter",
                'value' => "https://x.com/"
            ],
            [
                'country_id'=>"1",
                'key' => "thread",
                'value' => "https://www.threads.net/t/CuY8S0ASjXO",
            ],
            [
                'country_id'=>"1",
                'key' => "instagram",
                'value' => "https://www.instagram.com",
            ],

        ];
        Setting::insert($setting);
    }
    }
}
