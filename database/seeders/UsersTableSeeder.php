<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'System Admin',
            'email' => 'musab1marly@gmail.com',
            'password' => bcrypt('1421'),
            'role'=>'Admin'

        ]);
        DB::table('users')->insert([
            'name' => 'Organizer',
            'email' => 'Organizer@gmail.com',
            'password' => bcrypt('1421'),
            'role'=>'Organizer'

        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'User@gmail.com',
            'password' => bcrypt('1421'),
            'role'=>'User'

        ]);
    }
}
