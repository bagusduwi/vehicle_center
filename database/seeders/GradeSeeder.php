<?php

namespace Database\Seeders;

use App\Models\Grades;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grades::create([
            'grade' => 1,
            'position' => 'Non Staff'
        ]);
        Grades::create([
            'grade' => 2,
            'position' => 'Staff'
        ]);
        Grades::create([
            'grade' => 3,
            'position' => 'Manager'
        ]);
        Grades::create([
            'grade' => 4,
            'position' => 'General Manager'
        ]);
        Grades::create([
            'grade' => 4,
            'position' => 'Director'
        ]);
    }
}
