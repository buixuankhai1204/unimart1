<?php

namespace App\Http\Controllers;

use App\adminPost;
use App\adminProduct;
use App\Category;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
class ClientProductController extends Controller
{
    //
    public function index()
    {
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $product = adminProduct::latest()->paginate(8);
        return view('client.product.list', ['product' => $product, 'categories' => $categories]);
    }
    public function detail($id)
    {
        $product = adminProduct::where('id', $id)->firstorfail();
        $category_product=$product->category;
        $list_cate_product=adminProduct::where('category', $category_product)->get();
        return view('client.product.detail', ['product' => $product,'list_cate_product'=>$list_cate_product]);
    }
    public function category_list($id)
    {
        $categories_child = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $item = Category::where('id', $id)->get();
        foreach ($item as $item) {
            if ($item->category_id == null) {
                $item = Category::where('category_id', $id)->get();
                foreach ($item as $item) {
                    $item1[] = $item->id;
                }
                $product = adminProduct::whereIn('category', $item1)->paginate(8);
                return view('client.product.list', ['product' => $product, 'categories' => $categories_child]);
            }
            $product = adminProduct::where('category', $id)->paginate(8);
            return view('client.product.list', ['product' => $product, 'categories' => $categories_child]);
        }
    }
}
