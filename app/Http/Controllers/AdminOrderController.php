<?php

namespace App\Http\Controllers;
use App\custommer;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    public  function list(){
        $product_order=Custommer::latest()->paginate(10);
        $product_order_1=Custommer::latest();
        $product_3=custommer::where('status','đã hoàn thành')->latest();
        $product_2=custommer::where('status','đang xử lý')->latest();
        return view('admin.order.list',['product_order'=>$product_order,'product_order_1'=>$product_order_1 ,'product_order_3'=>$product_3,'product_order_2'=>$product_2]);
        
    }
    public function action(Request $request)
    {
        $item1 = $request->checkbox;
        if(isset($item1)){
            foreach ($item1 as $item) {
                $Custommer = Custommer::all()->find($item);
                if($request->option==0){
                    
                    $Custommer->status='đang xử lý';
                    $Custommer->save();
                }
                elseif($request->option==1){
                    $Custommer->status='đã hoàn thành';
                    $Custommer->save();
                } 
            }
        }else{
            return redirect('admin/order/list')->with('status','bạn chưa chọn sẳn phẩm!');
        }
        
            
        return redirect('admin/order/list')->with('status','bạn đã thay đổi thành công!');
    }
    public function delete($id){
        
        $customer= custommer::find($id);
        $customer->delete();
        return redirect('admin/order/list')->with('status','bạn đã xóa thành công!');   
} 
        public function status2(){
            $product_order_1=Custommer::latest();
        $product_3=custommer::where('status','đã hoàn thành')->latest();
        $product_2=custommer::where('status','đang xử lý')->latest();
            $product_order= custommer::where('status','đang xử lý')->latest()->paginate(10);
            return view('admin.order.list',['product_order'=>$product_order,'product_order_1'=>$product_order_1,'product_order_2'=>$product_2,'product_order_3'=>$product_3]);        
        }
        public function status1(){
            $product_order_1=Custommer::latest();
            $product_order=Custommer::latest()->paginate(10);
            $product_3=custommer::where('status','đã hoàn thành')->latest();
            $product_2=custommer::where('status','đang xử lý')->latest();
                return view('admin.order.list',['product_order'=>$product_order,'product_order_1'=>$product_order_1,'product_order_2'=>$product_2,'product_order_3'=>$product_3]);                  
        } public function status3(){
            $product_order_1=Custommer::latest();
            $product_3=custommer::where('status','đã hoàn thành')->latest();
            $product_2=custommer::where('status','đang xử lý')->latest();
                $product_order= custommer::where('status','đã hoàn thành')->latest()->paginate(10);
                return view('admin.order.list',['product_order'=>$product_order,'product_order_1'=>$product_order_1,'product_order_2'=>$product_2,'product_order_3'=>$product_3]);             
        }  
}
