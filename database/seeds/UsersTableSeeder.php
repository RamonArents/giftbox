<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //you can add admin users here. There is no limit for users. Just copy the object if you want more
        DB::table('users')->insert([
            'name' => '',
            'email' => '',
            'password' => Hash::make(''),
        ]);
    }
}
