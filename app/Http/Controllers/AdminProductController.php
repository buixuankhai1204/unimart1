<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\adminProduct;
use App\Category;
use App\User;

use SebastianBergmann\Environment\Console;

class AdminProductController extends Controller
{
    //
    public function list(Request $request){
        $product=adminProduct::latest()->paginate(10);
        $product_1=adminProduct::latest();
        $product_3=adminProduct::where('status','còn hàng')->latest();
        $product_2=adminProduct::where('status','hết hàng')->latest();
        return view('admin.product.list',['product'=>$product,'product_order_1'=>$product_1 ,'product_order_3'=>$product_3,'product_order_2'=>$product_2]);
    }
    public function store(Request $request){
        $request->validate([
            'product_name' => 'required|min:5',
            'product_price' => 'required',
            'product_configuration' => 'required|min:8',
            'product_content' => 'required|min:8',
            'option' => 'required',
        ]);
        $item=User::where('id',1)->firstorfail();
        adminProduct::create([
            'product_name'=>$request->input('product_name'),
            'product_price'=>$request->input('product_price'),
            'product_thumb'=>'bùi xuân khải',
            'category'=>$request->option,
            'product_configuration'=>$request->input('product_configuration'),
            'product_content'=>$request->input('product_content'),
            'status'=>$request->input('exampleRadios'),
            'date_create'=>'2020-10-12 09:42:16',
            'user_id'=>auth::user()->id,

        ]);
        return redirect('admin/product/list')->with('status','đã thêm thành công sản phẩm mới');
    }
    public  function add(){
        $categories = Category::whereNull('category_id')
	    ->with('childrenCategories')
	    ->get();
        return view('admin.product.add',['categories'=>$categories]);
    }
    
    public  function Cat(){
        return view('admin.product.cat_product');
    }
    public function delete($id){
        
            $product= adminProduct::find($id);
            $product->delete();
            return redirect('admin/product/list')->with('status','bạn đã xóa thành công!');   
    }
    public function action(Request $request)
    {
        $item1 = $request->checkbox;
        foreach ($item1 as $item) {
            $product = adminProduct::all()->find($item);
            if($request->option=='hết hàng'){
                
                $product->status='hết hàng';
                $product->save();
            }
            elseif($request->option=='còn hàng'){
                echo 'oko';
                $product->status='còn hàng';
                $product->save();
            }
            else{
                echo"không có sản phẩm nào để thay đổi";
            }
        }
            
        return redirect('admin/product/list')->with('status','bạn đã thay đổi thành công!');
    }
    public function edit($id)
    {
        $product=adminProduct::find($id);
        return view('admin.product.edit',['product'=>$product]);
    }
    public function update(Request $request,$id)
    {
        $product=adminProduct::find($id);
        $request->validate([
            'product_name' => 'required|min:5',
            'product_price' => 'required',
            'product_configuration' => 'required|min:8',
            'product_content' => 'required|min:8',
            'option' => 'required',
        ]);
        
        adminProduct::where('id',$id)->update([
            'product_name'=>$request->input('product_name'),
            'product_price'=>$request->input('product_price'),
            'product_thumb'=>'bùi xuân khải',
            'category'=>$request->option,
            'product_configuration'=>$request->input('product_configuration'),
            'product_content'=>$request->input('product_content'),
            'status'=>$request->input('exampleRadios'),
            'date_create'=>'2020-10-12 09:42:16',
            'user_id'=>auth::user()->id,
        ]);
        return redirect('admin/product/list')->with('status','bạn đã thay đổi  thành công!');   

    }
    public function status2(){
        $product_1=adminProduct::latest();
    $product_3=adminProduct::where('status','còn hàng')->latest();
    $product_2=adminProduct::where('status','hết hàng')->latest();
        $product= adminProduct::where('status','hết hàng')->latest()->paginate(10);
        return view('admin.product.list',['product'=>$product,'product_order_1'=>$product_1,'product_order_2'=>$product_2,'product_order_3'=>$product_3]);        
    }
    public function status1(){
        $product_1=adminProduct::latest();
        $product=adminProduct::latest()->paginate(10);
        $product_3=adminProduct::where('status','còn hàng')->latest();
        $product_2=adminProduct::where('status','hết hàng')->latest();
            return view('admin.product.list',['product'=>$product,'product_order_1'=>$product_1,'product_order_2'=>$product_2,'product_order_3'=>$product_3]);                  
    } public function status3(){
        $product_1=adminProduct::latest();
        $product_3=adminProduct::where('status','còn hàng')->latest();
        $product_2=adminProduct::where('status','hết hàng')->latest();
            $product= adminProduct::where('status','còn hàng')->latest()->paginate(10);
            return view('admin.product.list',['product'=>$product,'product_order_1'=>$product_1,'product_order_2'=>$product_2,'product_order_3'=>$product_3]);             
    }  
}
