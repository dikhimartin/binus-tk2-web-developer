<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FacultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->insert([
            'id' => Str::uuid(),
            'code' => "CS",
            'name' => "Computer Science",
            'description' => "Computer science is the study of computers, including their theoretical and algorithmic foundations, hardware and software, and their uses for processing information",
            'status' => "Y",
        ]);
    }
}
