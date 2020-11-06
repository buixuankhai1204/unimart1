<?php

use App\Auth;
Use Illuminate\Foundation\Auth\User;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class adminUserController extends Controller
{
    //
    public function list(Request $request){
        $keyword='';
        if($request->input('keyword')){
            $keyword=$request->input('keyword');
        }
        $user=User::where('name','LIKE',"%{$keyword}%")->paginate(10);
        return view('admin.user.list', ['user'=> $user]);
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:10',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
        ]);
            return redirect('admin/user/list')->with('status','đã thêm thành công thành viên mới');
    }
    public function add(){
        return view('admin.user.add');
    }
    public function delete($id){
        if(Auth::id()!=$id){
            $user= User::find($id);
            $user->delete();
            return redirect('admin/user/list')->with('status','bạn đã xóa thành công!');
        }else{
            return redirect('admin/user/list')->with('status','bạn không thể tự xóa chính mình ra khỏi hệ thống');
        }
        
    }
    public function action(Request $request)
    {
        $item = $request->checkbox;
        foreach ($item as $item) {
            $user = User::all()->find($item);
            if($request->option=='xóa'){
                $user->delete();
            }
            else{
                echo"không có user nào để xóa";
            }
        }
        return redirect('admin/user/list')->with('status','bạn đã xóa thành công!');
    }
    public function edit($id)
    {
        $user=User::find($id);
        return view('admin.user.edit',['user'=>$user]);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|min:10',
            'password' => 'required|min:8',
        ]);
        
        User::where('id',$id)->update([
            'name'=>$request->input('name'),
            'password'=>$request->input('password'),
        ]);
    }
}
