<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuotesTableSeeder extends Seeder
{
    // Citazioni per database
    public function run()
    {
        DB::table('quotes')->insert([[
            'phrase'    => 'L\'arte è la bugia che ci fa comprendere la verità',
            'author'    => 'Pablo Picasso'
        ], [
            'phrase'    => 'L\'arte è la maniera più intensa di vivere; è vita stessa',
            'author'    => 'Oscar Wilde'
        ], [
            'phrase'    => 'La scultura è l\'arte di ciò che manca',
            'author'    => 'Jean-Paul Sartre'
        ], [
            'phrase'    => 'La pittura è poesia silenziosa, e la poesia è pittura parlante',
            'author'    => 'Simonides',
        ], [
            'phrase'    => 'La pittura è una poesia che si vede e non si sente, e la poesia è una pittura che si sente e non si vede',
            'author'    => 'Leonardo da Vinci',
        ], [
            'phrase'    => 'Ogni pittore dipinge sè stesso',
            'author'    => 'Jackson Pollock'
        ], [
            'phrase'    => 'La fotografia è la storia fermata, il momento preservato',
            'author'    => 'Dorothea Lange'
        ]]);
    }
}
