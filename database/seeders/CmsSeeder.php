<?php

namespace Database\Seeders;

use App\Models\Cms;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn('Running CMS Seeder!');
        if (Cms::count() === 0) {
            $data = [
                [
                    'admin_id' => 1,
                    'country_id' => 1,
                    'slug' => Str::slug('Privacy Policy'),
                    'title' => 'Privacy Policy',
                    'content' => 'At Web Games, we value your privacy and are committed to protecting your personal information. This Privacy Policy outlines how we collect, use, and safeguard the data you provide to us. By interacting with our website or services, you agree to the collection and use of information in accordance with this policy. ',
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'admin_id' => 1,
                    'country_id' => 1,
                    'slug' => Str::slug('Terms and Conditions'),
                    'title' => 'Terms & Conditions',
                    'content' => 'By accessing or using the website and services provided by Web Games, you agree to comply with and be bound by these Terms and Conditions. If you have any questions or need further clarification, please contact us at contact@webgamges.com.',
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ];
            Cms::insert($data);
        }
        $this->command->warn('Completed CMS Seeder!');
    }
}
