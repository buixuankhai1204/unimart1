<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    //
    public  function add(){
        return view('admin.page.add');
    }
    public  function list(){
        return view('admin.page.list');
    }
}
