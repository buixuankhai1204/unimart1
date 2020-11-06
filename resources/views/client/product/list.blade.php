@extends('layouts/client')
@section('dashboard')
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif 
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Laptop</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="3">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach($product as $item)
                        <li>
                            <a href="{{route('product.detail', $item->id)}}" title="" class="thumb">
                                <img src="{{url('/public/upload',$item->product_thumb)}}">
                            </a>
                            <a href="{{route('product.detail', $item->id)}}" title="" class="product-name">{{$item->product_name}}</a>
                            <div class="price">
                                <span class="new">{{$item->product_price}}</span>
                            </div>
                            <div class="action clearfix">
                                <a href="{{route('cart.add',$item->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="{{route('cart.buynow',$item->id)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    {{$product->links()}}
                </div>
            </div>
        </div>
@endsection