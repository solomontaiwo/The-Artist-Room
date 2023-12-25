<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'          => 'Solomon',
            'surname'       => 'Taiwo',
            'email'         => 'solomontaiwo@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s'),
            'is_admin'      => true,
        ]);

        User::create([
            'name'          => 'Gaia',
            'surname'       => 'Marzola',
            'email'         => 'gaiamarzola@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s'),
            'is_admin'      => true,
        ]);

        User::create([
            'name'          => 'Giorgia',
            'surname'       => 'Pirelli',
            'email'         => 'giorgiapirelli@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s'),
            'is_admin'      => true,
        ]);

        User::create([
            'name'          => 'Luca',
            'surname'       => 'Gaudenzi',
            'email'         => 'lucagaudenzi@theartistroom.com',
            'password'      => bcrypt('password'),
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s'),
            'is_admin'      => true,
        ]);
    }
}
