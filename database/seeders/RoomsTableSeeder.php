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
            'name'              => 'Aula Pirelloni',
            'description'       => 'Breve descrizione aula Pirelloni',
            'address'           => 'Via Dei Peracottari, 15',
            'size'              => 100, // metri quadri
            'available_seats'   => 0,
            'updated_at'        => date('Y-m-d h:i:s'),
            'created_at'        => date('Y-m-d h:i:s')
        ], [
            'name'              => 'Aula Gaudemagna',
            'description'       => 'Breve descrizione aula Gaudemagna',
            'address'           => 'Via Frassina, 51',
            'size'              => 50, // metri quadri
            'available_seats'   => 50,
            'updated_at'        => date('Y-m-d h:i:s'),
            'created_at'        => date('Y-m-d h:i:s')
        ], [
            'name'              => 'Aula Taiwani',
            'description'       => 'Breve descrizione aula Taiwani',
            'address'           => 'Via dei Marnoni, 2',
            'size'              => 75, // metri quadri
            'available_seats'   => 50,
            'updated_at'        => date('Y-m-d h:i:s'),
            'created_at'        => date('Y-m-d h:i:s')
        ], [
            'name'              => 'Aula Marzoletti',
            'description'       => 'Breve descrizione aula Marzoletti',
            'address'           => 'Via Edmondo De Amicis, 66',
            'size'              => 150, // metri quadri
            'available_seats'   => 50,
            'updated_at'        => date('Y-m-d h:i:s'),
            'created_at'        => date('Y-m-d h:i:s')
        ]]);
    }
}
