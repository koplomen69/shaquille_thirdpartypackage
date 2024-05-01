<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'firstname' => 'shaquille',
                'lastname' => 'rayhan',
                'email' => 'shaquille@gmail.com',
                'age' => 20,
                'position_id' => 1
            ],
            [
                'firstname' => 'canggih',
                'lastname' => 'dedi',
                'email' => 'dedi@gmail.com',
                'age' => 25,
                'position_id' => 2
            ],
            [
                'firstname' => 'budi',
                'lastname' => 'anduk',
                'email' => 'budi@gmail.com',
                'age' => 23,
                'position_id' => 3
            ],
        ]);
    }
}
