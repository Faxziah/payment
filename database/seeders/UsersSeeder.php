<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Иванов Иван Иванович',
            'login' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'is_admin' => 1,
        ]);

        \App\Models\User::factory(10)->create();
    }
}
