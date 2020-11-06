<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class Categorycontroller extends Controller
{
    //
    public function index()
	{
	    $categories = Category::whereNull('category_id')
	    ->with('childrenCategories')
	    ->get();
//    dd($categories);
	   return view('categories', compact('categories'));
		 }
		 

}
