<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create multiple users
                DB::table('users')->insert([
                    [
                        'username' => 'admin@administration.com',
                        'password' => bcrypt('admin123'),
                        'created_at' => date('Y-m-d H:i:s')
                    ],
                    [
                        'username' => 'joaozinho@gmail.com',
                        'password' => bcrypt('joaozinho'),
                        'created_at' => date('Y-m-d H:i:s')
                    ],
                ]);
    }
}
