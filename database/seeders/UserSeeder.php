<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    User::factory()->create([
      'id' => 'f7b1b3b0-0b1b-4b1b-8b1b-0b1b2b3b4b5a',
      'name' => 'Admin',
      'email' => 'admin@far.st',
      'password' => bcrypt('Password.123'),
    ]);
  }
}
