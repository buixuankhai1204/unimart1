
@extends('layouts/client')
@section('dashboard')
<?php use Illuminate\Support\str; ?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($post as $item)
                        <li class="clearfix">
                            <a href="{{route('post.detail',$item->id)}}" title="" class="thumb fl-left">
                                <img src="{{asset('public/upload/img-post-01.jpg')}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="{{route('post.detail',$item->id)}}" title="" class="title">{{$item->post_title}}</a>
                                <span class="create-date">{{$item->created_at }}</span>
                                <p class="desc">{!!$item->post_content!!}}</p>
                            </div>
                        </li>
                        @endforeach
                        {{$post->links()}}
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
@endsection