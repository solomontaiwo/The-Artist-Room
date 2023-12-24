<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    { 
        DB::table('users')->insert([[
            'name'          => 'Solomon',
            'surname'       => 'Taiwo',
            'email'         => 'solomontaiwo@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s')
        ], [
            'name'          => 'Giorgia',
            'surname'       => 'Pirelli',
            'email'         => 'giorgiapirelli@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s')
        ], [
            'name'          => 'Luca',
            'surname'       => 'Gaudenzi',
            'email'         => 'lucagaudenzi@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s')
        ], [
            'name'          => 'Gaia',
            'surname'       => 'Marzola',
            'email'         => 'gaiamarzola@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s')
        ]]);
    }
}
