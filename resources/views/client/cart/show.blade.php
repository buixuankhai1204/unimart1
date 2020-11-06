@extends('layouts/client')
@section('dashboard')
<?php

use Gloudemans\Shoppingcart\Facades\Cart;


?>
<style>
    .sidebar{
        display:none;
    }
</style>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm làm đẹp da</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <form method="POST" action="{{route('cart.update')}}">
                    @csrf
                    @if(cart::count()>0)
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                                <td>xóa</td>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach(cart::content() as $item)

                            <tr>
                                <td>HCA00032</td>
                                <td>
                                    <a href="" title="" class="thumb">
                                        <img src="{{url('public/upload',$item->options->images)}}" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a href="" title="" class="name-product">{{$item->name  }}</a>
                                </td>
                                <td>{{$item->price}}</td>
                                <td>
                                    <input type="number" min='1' max='10' name="qty[{{$item->rowId}}]" value="{{$item->qty}}" style="width:50px; text-align: center" value="{{$item->qty}}"> </td>
                                <td>{{$item->subtotal()}}</td>
                                <td>
                                    <a href="" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                </td>
                                <td><a href="{{route('cart.remove',$item->rowId)}}" class="text-danger">Xóa</a></td>
                            </tr>
                            @endforeach
                            @else
                            <p>không có sản phẩm nào được mua</p>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span>{{cart::subtotal()}}</span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <input type="submit" class="btn btn-primary" value="cập nhật giỏ hàng">
                                            <a href="{{route('cart.checkout')}}" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>

            </div>
        </div>

        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="?page=home" title="" id="buy-more">Mua tiếp</a><br />
                <a href="" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>

        </div>
    </div>
</div>
@endsection