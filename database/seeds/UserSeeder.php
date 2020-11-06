<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Syakir',
            'email' => 'syakir@gmail.com',
            'password' => 'syakir123',
        ]);
        DB::table('users')->insert([
            'name' => 'Fauzi',
            'email' => 'fauzi@gmail.com',
            'password' => 'fauzi123',
        ]);
        DB::table('users')->insert([
            'name' => 'Ehun',
            'email' => 'ehun@gmail.com',
            'password' => 'ehun123',
        ]);
    }
}
