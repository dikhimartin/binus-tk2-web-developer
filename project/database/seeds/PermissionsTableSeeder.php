<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => 'roles-list',
                'display_name' => 'Role List',
                'description' => 'Role List',
                'sort' => 2,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 2,
                'name' => 'roles-create',
                'display_name' => 'Role Add',
                'description' => 'Role Add',
                'sort' => 2,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 3,
                'name' => 'roles-edit',
                'display_name' => 'Role Edit',
                'description' => 'Role Edit',
                'sort' => 2,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 4,
                'name' => 'roles-delete',
                'display_name' => 'Role Delete',
                'description' => 'Role Delete',
                'sort' => 2,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 5,
                'name' => 'users-list',
                'display_name' => 'Users List',
                'description' => 'Users list',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 6,
                'name' => 'users-create',
                'display_name' => 'Users Create',
                'description' => 'Users create',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 7,
                'name' => 'users-edit',
                'display_name' => 'Users Edit',
                'description' => 'Users edit',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 8,
                'name' => 'users-delete',
                'display_name' => 'Users Delete',
                'description' => 'Users delete',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 13,
                'name' => 'students-list',
                'display_name' => 'Students List',
                'description' => 'Students List',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 14,
                'name' => 'students-create',
                'display_name' => 'Students Create',
                'description' => 'Students Create',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 15,
                'name' => 'students-edit',
                'display_name' => 'Students Edit',
                'description' => 'Students Edit',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 16,
                'name' => 'students-delete',
                'display_name' => 'Students Delete',
                'description' => 'Students Delete',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 17,
                'name' => 'grades-list',
                'display_name' => 'Grades List',
                'description' => 'Grades List',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 18,
                'name' => 'grades-create',
                'display_name' => 'Grades Create',
                'description' => 'Grades Create',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 19,
                'name' => 'grades-edit',
                'display_name' => 'Grades Edit',
                'description' => 'Grades Edit',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 20,
                'name' => 'grades-delete',
                'display_name' => 'Grades Delete',
                'description' => 'Grades Delete',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ]
        ]);
    }
}
