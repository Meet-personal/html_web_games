<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn('Running Country Seeder!');
        if (Country::count() === 0) {
            $country = [
                'admin_id' => 1,
                'country' => "India",
                'code' => "91",
                'flag' => "",
                'status' => 1
            ];
            Country::create($country);
        }
        $this->command->warn('Completed Country Seeder!');
    }
}
