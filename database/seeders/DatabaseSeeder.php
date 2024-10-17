<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Utils\UserRoleEnum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $email = 'mk.utif.dori@pertamina.com';
        User::factory()->create([
            'name' => 'Utif Milkedori',
            'email' => $email,
            'username' => explode('@', $email)[0],
            'role' => UserRoleEnum::USER_DEV_ROLE->value
        ]);
    }
}
