<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'Guest User',
            'email' => 'guest@power-phrase.com',
            'password' => Hash::make('guestuser'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($param);
    }
}
