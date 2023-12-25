<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('rooms')->insert([[
            'name'          => 'Aula Magna',
            'description'   => 'Aula ampia dotata di numerosi banchi, prese per ricaricare i propri dispositivi, tavolozze e colori',
            'address'       => 'Via Dei Peracottari, 15',
            'dimensions'    => 50,
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
