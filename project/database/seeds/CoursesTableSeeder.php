<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'id' => Str::uuid(),
                'code' => "ISYS6362036",
                'name' => "Database Design",
                'description' => "Lorem ipsum dolor sit amet",
                'status' => "Y"
            ],
            [
                'id' => Str::uuid(),
                'code' => "ISYS6332036",
                'name' => "Data Warehouse",
                'description' => "Lorem ipsum dolor sit amet",
                'status' => "Y"
            ],
            [
                'id' => Str::uuid(),
                'code' => "COMP6621036",
                'name' => "Web Programming",
                'description' => "Lorem ipsum dolor sit amet",
                'status' => "Y"
            ],
            [
                'id' => Str::uuid(),
                'code' => "COMP6620036",
                'name' => "Pattern Software Design",
                'description' => "Lorem ipsum dolor sit amet",
                'status' => "Y"
            ],
            [
                'id' => Str::uuid(),
                'code' => "COMP6618036",
                'name' => "Object Oriented Programming",
                'description' => "Lorem ipsum dolor sit amet",
                'status' => "Y"
            ],
            [
                'id' => Str::uuid(),
                'code' => "COMP6148036",
                'name' => "Programming Language Concepts",
                'description' => "Lorem ipsum dolor sit amet",
                'status' => "Y"
            ],
            [
                'id' => Str::uuid(),
                'code' => "COMP6619036",
                'name' => "Advanced Object Oriented Programming",
                'description' => "Lorem ipsum dolor sit amet",
                'status' => "Y"
            ]
        ]);
    }
}
