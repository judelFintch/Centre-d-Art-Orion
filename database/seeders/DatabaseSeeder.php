<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@centreartorion.cd'],
            ['name'  => 'Admin Orion', 'password' => bcrypt('admin1234')],
        );

        $this->call(OrionSeeder::class);
    }
}
