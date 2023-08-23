<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create(['username' => 'victor', 'name' => 'Victor', 'email' => 'victor@victor.com', 'password' => bcrypt('password')]);
        User::create(['username' => 'teste', 'name' => 'Teste', 'email' => 'teste@teste.com', 'password' => bcrypt('password')]);

        $user->assignRole('Super Admin');
    }
}
