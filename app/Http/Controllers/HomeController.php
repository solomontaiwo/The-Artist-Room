<?php

namespace App\Http\Controllers;

use App\Models\Quote;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Per avere una citazione casuale in home
        $quote = Quote::inRandomOrder()->first();
        return view('home', compact('quote'));
    }
}
