<?php

namespace App\Http\Controllers;

use App\adminPost;
use Illuminate\Http\Request;

class ClientPostController extends Controller
{
    public function index(){
        $post=adminPost::latest()->paginate(10);
        return view('client.post.list',['post'=>$post]);
    }
    public function detail($id){
        $post=adminPost::where('id',$id)->firstorfail();

        return view('client.post.detail',['post'=>$post]);
    }
    
}
