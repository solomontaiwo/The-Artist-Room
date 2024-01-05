<?php

namespace Database\Seeders;

use Database\Seeders\AdminSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Seed che vengono immessi nel database con il comando php artisan db:seed
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            UsersTableSeeder::class,
            RoomsTableSeeder::class,
            QuotesTableSeeder::class
        ]);
    }
}
