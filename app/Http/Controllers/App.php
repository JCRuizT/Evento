<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class App extends Controller
{
    public function index(){
        
        return view("App");

    }
}
