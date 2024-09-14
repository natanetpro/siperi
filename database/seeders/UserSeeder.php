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
        // admin
        $admin = User::create([
            'nama' => 'admin',
            'email' => 'admin@siperi.test',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'pemohon_id' => null,
        ]);

        // assign role admin
        $admin->assignRole('Administrator');
    }
}
