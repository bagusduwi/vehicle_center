<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('indonesia')
        ]);
        User::create([
            'name' => 'Roni',
            'username' => 'roni',
            'password' => Hash::make('indonesia'),
            'grades_id' => 1
        ]);
        User::create([
            'name' => 'Yanti',
            'username' => 'yanti',
            'password' => Hash::make('indonesia'),
            'grades_id' => 2
        ]);
        User::create([
            'name' => 'Sumi',
            'username' => 'sumi',
            'password' => Hash::make('indonesia'),
            'grades_id' => 3
        ]);
    }
}
