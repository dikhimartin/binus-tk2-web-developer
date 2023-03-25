<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id_users' => 'K00001',
                'username' => 'binusian',
                'name' => 'Binusian',
                'password' => Hash::make('binusian'),
                'email' => 'binusian@binus.ac.id',
                'telephone' => '08123456789',
                'date_birth' => '1995-08-01',
                'address' => 'Jakarta',
                'gender' => 'L',
                'id_level_user' => 1,
                'image' => '',
                'created_by' => 'K00001',
                'updated_by' => 'K00001',
                'status' => 'Y',
                'additional' => null,
                'remember_token' => null,
            ],
        ]);
    }
}
