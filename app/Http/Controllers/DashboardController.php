<?php

namespace App\Http\Controllers;
use App\Custommer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    //
    public function index(){
        $status_success=Custommer::where('status','đã hoàn thành')->latest()->paginate(10);
        $status_success=Custommer::where('status','đã hoàn thành')->latest()->paginate(10);
        $status_warning=Custommer::where('status','đang xử lý')->latest()->paginate(10);
        $product_order=Custommer::latest()->paginate(10);
        $Custommer = Custommer::select(\DB::raw("SUM(total_price) as count"))
                    ->whereYear('created_at', '2020')
                    ->groupBy(\DB::raw("MONTH (created_at),'0'"))
                    ->pluck('count');
            if(!$Custommer){
                $result=0;  
        }
        return view('admin.dashboard',['Custommer'=>$Custommer,'product_order'=>$product_order,'status_success'=>$status_success,'status_warning'=>$status_warning]);
    }
}
