<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'role' => 'admin',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}