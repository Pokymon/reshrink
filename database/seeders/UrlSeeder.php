<?php

namespace Database\Seeders;

use App\Models\Url;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Url::insert([
            [
                'url' => 'https://reshr.ink',
                'code' => 'dashboard',
                'domain_id' => 1,
                'user_id' => 1,
            ],
            [
                'url' => 'https://reshr.ink',
                'code' => 'urls',
                'domain_id' => 1,
                'user_id' => 1,
            ],
            [
                'url' => 'https://reshr.ink',
                'code' => 'domains',
                'domain_id' => 1,
                'user_id' => 1,
            ]
        ]);
    }
}
