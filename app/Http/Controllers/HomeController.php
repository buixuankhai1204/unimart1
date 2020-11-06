<?php

namespace App\Http\Controllers;

use App\adminProduct;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $item_iphone = Category::where('category_id', 1)->get();
        foreach ($item_iphone as $item) {
            $item1[] = $item->id;
        }
        $product_phone = adminProduct::whereIn('category', $item1)->latest()->paginate(8);

        $item_laptop = Category::where('category_id', 2)->get();
        foreach ($item_laptop as $item) {
            $item2[] = $item->id;
        }
        $product_laptop = adminProduct::whereIn('category', $item2)->latest()->paginate(8);

        $item_clock = Category::where('category_id', 8)->get();
        foreach ($item_clock as $item) {
            $item3[] = $item->id;
        }
        $product_clock = adminProduct::whereIn('category', $item3)->latest()->paginate(8);
        return view('welcome', [
            'product_phone' => $product_phone,
            'product_laptop' => $product_laptop,
            'product_clock' => $product_clock,
        ]);
    }
    public function index1(){
        return view('home');
    }
}
