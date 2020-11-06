<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class clientAboutcontroller extends Controller
{
    //
    public function index(){
        return view('client.about.list');
    }
    
}
