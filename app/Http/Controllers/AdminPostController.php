<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\adminPost;
use App\User;

use SebastianBergmann\Environment\Console;

class AdminPostController extends Controller
{
    //
    public function list(Request $request){
        $keyword='';
        if($request->input('keyword')){
            $keyword=$request->input('keyword');
        }
        $post=adminPost::latest()->paginate(10);
        $post_1=adminPost::latest();
        $post_3=adminPost::where('status','đã đăng')->latest();
        $post_2=adminPost::where('status','chờ duyệt')->latest();
        return view('admin.post.list',['post'=>$post,'post_1'=>$post_1,'post_3'=>$post_3,'post_2'=>$post_2]);
    }
    public function store(Request $request){
        $request->validate([
            'post_title' => 'required|min:5',
            'post_content' => 'required|min:8',
            'option' => 'required|not_in:0',
        ]);
        adminPost::create([
            'post_title'=>$request->input('post_title'),
            'post_thumb'=>'bùi xuân khải',
            'category'=>$request->option,
            'post_content'=>$request->input('post_content'),
            'status'=>$request->input('exampleRadios'),
            'date_create'=>now(),
            'user_id'=>auth::user()->id,

        ]);
        return redirect('admin/post/list')->with('status','đã thêm thành công bài viết mới');
    }
    public  function add(){
        return view('admin.post.add');
    }
    
    public  function Cat(){
        return view('admin.post.cat_product');
    }
    public function delete($id){
        
            $post= adminPost::find($id);
            $post->delete();
            return redirect('admin/post/list')->with('status','bạn đã xóa thành công!');   
    }
    public function action(Request $request)
    {
        $item1 = $request->checkbox;
        if(isset($item1)){
            foreach ($item1 as $item) {
                $product = adminPost::all()->find($item);
                if($request->option=='chờ duyệt'){
                    
                    $product->status='chờ duyệt';
                    $product->save();
                }
                else{
                    
                    $product->status='đã đăng';
                    $product->save();
                }
                
            }
        }
        else{
            return redirect('admin/post/list')->with('status','bạn chưa chọn bài viết');
        }
        
            
        return redirect('admin/post/list')->with('status','bạn đã thay đổi thành công!');
    }
    public function edit($id)
    {
        $post=adminPost::find($id);
        return view('admin.post.edit',['post'=>$post]);
    }
    public function update(Request $request,$id)
    {
        $product=adminPost::find($id);
        $request->validate([
            'post_title' => 'required|min:5',
            'post_content' => 'required|min:8',
            'option' => 'required|not_in:0',
        ]);
        
        adminPost::where('id',$id)->update([
            'post_title'=>$request->input('post_title'),
            'post_thumb'=>'bùi xuân khải',
            'category'=>$request->option,
            'post_content'=>$request->input('post_content'),
            'status'=>$request->input('exampleRadios'),
            'date_create'=>now(),
            'user_id'=>auth::user()->id,
        ]);
        return redirect('admin/post/list')->with('status','bạn đã thay đổi  thành công!');   

    }
    public function status2(){
        $post_1=adminPost::latest();
    $post_3=adminPost::where('status','đã đăng')->latest();
    $post_2=adminPost::where('status','chờ duyệt')->latest();
        $post= adminPost::where('status','chờ duyệt')->latest()->paginate(10);
        return view('admin.post.list',['post'=>$post,'post_1'=>$post_1,'post_2'=>$post_2,'post_3'=>$post_3]);                  
    }
    public function status1(){
        $post=adminPost::latest()->paginate(10);
        $post_1=adminPost::latest();
        $post_3=adminPost::where('status','đã đăng')->latest();
        $post_2=adminPost::where('status','chờ duyệt')->latest();
            return view('admin.post.list',['post'=>$post,'post_1'=>$post_1,'post_2'=>$post_2,'post_3'=>$post_3]);                  
    } public function status3(){
        $post_1=adminPost::latest();
        $post_3=adminPost::where('status','đã đăng')->latest();
        $post_2=adminPost::where('status','chờ duyệt')->latest();
            $post= adminPost::where('status','đã đăng')->latest()->paginate(10);
            return view('admin.post.list',['post'=>$post,'post_1'=>$post_1,'post_2'=>$post_2,'post_3'=>$post_3]);             
    }  
}
