<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([[
            'name'          => 'Pino',
            'surname'       => 'Pinoli',
            'email'         => 'pinopinoli@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s'),
        ], [
            'name'          => 'Matteo',
            'surname'       => 'Solo',
            'email'         => 'matteosolo@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s'),
        ], [
            'name'          => 'Harry',
            'surname'       => 'Potter',
            'email'         => 'harrypotter@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s'),
        ], [
            'name'          => 'Ryu',
            'surname'       => 'Hayabusa',
            'email'         => 'ryuhayabusa@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s'),
        ]]);
    }
}
