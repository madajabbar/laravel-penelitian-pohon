<?php

namespace Database\Seeders;

use App\Traits\CreateDataTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    use CreateDataTrait;
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->CreateUser(
                [
                    'name' => 'user_'.$i,
                    'email' => 'user'.$i.'@example.com',
                    'password' => Hash::make('rahasia123'),
                    'is_admin' => 'false',
                ]
            );
        }
    }
}
