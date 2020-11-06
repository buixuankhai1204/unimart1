<?php

namespace App\Http\Controllers;

use App\adminProduct;
use Illuminate\Http\Request;
use App\Custommer;
use App\cart as AppCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
class CartController extends Controller
{
    //
    public function show()
    {
        
        return view('client.cart.show');
    }
    public function checkout()
    {
        $item=Cart::content();
        dump($item);
        echo "<pre>";
        print_r(json_encode($item));
        echo "</pre>";
        $code=random_int(1,100000);
        $code1=str::of('UNI#')->append($code);
        echo ($code1);

        return view('client.cart.checkout');
    }
    public function add(request $request, $id)
    {
        $product = adminProduct::find($id);
        cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'qty' => 1,
            'price' => $product->product_price,
            'options' => ['images' => $product->product_thumb],

        ]);
        return redirect()->back()->with('status', 'bạn đã thêm vào giỏ hàng');
    }
    public function buynow(request $request, $id)
    {
        $product = adminProduct::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'qty' => 1,
            'price' => $product->product_price,
            'options' => ['images' => $product->product_thumb],
        ]);
        return redirect('cart');
    }
    public function remove($rowId){
        cart::remove($rowId);
        return redirect('cart');
    }
    public function update(Request $request){
        // dd($request->all());
        $data=$request->get('qty');
        foreach($data as $k=>$v)
        {
            cart::update($k,$v);
        }
        return redirect('cart');
    } 
    // public function checkout(Request $request){

    // } 
    public function store(Request $request){
        $request->validate([
            'fullname' => 'required|min:8',
            'email' => 'required|email',
            'address' => 'required|min:8',
            'phone' => 'numeric|min:8',
            'note' => 'required',
        ]);
        $item=Cart::content();
        $product_cart=json_encode($item);
        $code=random_int(1,100000);
        $code1=str::of('UNI#')->append($code);
        Custommer::create([
            'fullname'=>$request->input('fullname'),
            'email'=>$request->input('email'),
            'address'=>$request->input('address'),
            'phone'=>$request->input('phone'),
            'note'=>$request->input('note'),
            'product_code'=>$code1,
            'product_cart'=>$product_cart,
            'status'=>'đang xử lý',
            'qty'=>Cart::count(),
            'total_price'=>Cart::subtotal(),
        ]);
        
            return redirect('/')->with('status','bạn đã đặt hàng thành công, vui lòng kiểm tra email của bạn!');
    } 
}
