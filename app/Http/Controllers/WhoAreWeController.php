<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhoAreWeController extends Controller
{
    public function index()
    {
        return view('who-are-we.index');
    }
}
