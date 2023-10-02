<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Domain::create([
            'domain' => env('APP_DOMAIN', '127.0.0.1'),
            'user_id' => 1,
            'is_public' => true,
        ]);
    }
}
