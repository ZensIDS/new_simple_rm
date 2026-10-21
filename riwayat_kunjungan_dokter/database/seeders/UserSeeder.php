<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'nomor' => '123456',
            'name' => 'Admin',
            'full_name' => 'Admin Satu',
            'email' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        $admin->assignRole('admin');

    }
}
