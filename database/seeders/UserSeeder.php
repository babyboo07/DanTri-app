<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => '1',
            ],
            [
                'name' => 'Author',
                'email' => 'author@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => '3',
            ],
            [
                'name' => 'Approved',
                'email' => 'approved@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => '4',
            ],
            [
                'name' => 'test1',
                'email' => 'test1@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => '2',
            ],
            [
                'name' => 'test2',
                'email' => 'test2@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => '2',
            ],
        ];
        DB::table('users')->insert($data);
    }
}
