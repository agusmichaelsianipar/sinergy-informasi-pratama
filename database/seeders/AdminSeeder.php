<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        User::create([
            'firstname' => $faker->firstName(),
            'lastname' => $faker->lastName(),
            'email' => $faker->email(),
            'password' => Hash::make('sipsip123'),
            'user_status' => true,
            'is_admin' => true,
        ]);
    }
}
