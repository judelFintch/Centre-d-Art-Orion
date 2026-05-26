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
        User::updateOrCreate(
            ['email' => 'admin@centreartorion.cd'],
            [
                'name'              => 'Admin Orion',
                'password'          => bcrypt('Orion@2026'),
                'email_verified_at' => now(),
            ]
        );

        $this->call(OrionSeeder::class);
    }
}
