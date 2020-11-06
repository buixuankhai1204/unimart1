@extends('layouts/layout')

@section('dashboard')
@php
use Illuminate\Support\Arr;

 @endphp
<div id="content" class="container-fluid">
    <div class="card">
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{route('order.status_1')}}" class="text-primary">đơn hàng<span class="text-muted">({{$product_order_1->count()}})</span></a>
                <a href="{{route('order.status_2')}}" class="text-primary">đang xử lý<span class="text-muted">({{$product_order_2->count()}})</span></a>
                <a href="{{route('order.status_3')}}" class="text-primary">đã hoàn thành<span class="text-muted">({{$product_order_3->count()}})</span></a>
            </div>
            <div class="form-action form-inline py-3">
            <form action="{{url('/admin/order/list')}}" method="POST">
                @csrf
                    <select  name="option" class="form-control mr-1" id="">
                        <option>Chọn</option>
                        <option value="0">đang xử lý</option>
                        <option value="1">đã hoàn thành</option>
                    </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                @php
                $t=0;
                    @endphp
                @foreach($product_order as $item)
                @php
                $t++;
                $item2=json_decode($item->product_cart);
                
                $random1=last($item2);
                @endphp
                    <tr>
                        <td>
                            <input type="checkbox" name="checkbox[]" value="{{$item->id}}">
                        </td>
                        <td>{{$t}}</td>
                        <td>{{$item->product_code}}</td>
                        <td>
                            {{$item->fullname}}<br>
                            {{$item->phone}}
                        </td>
                        <td><a href="#">{{$random1->name}}</a></td>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->total_price}}</td>
                        <td><span class="badge badge-warning">{{$item->status}}</span></td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a href="" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('order.delete',$item->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Trước</span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        </form>

    </div>
</div>
<script>

$(document).ready(function(){
  $(".badge-warning:contains(đã hoàn thành)").css("background-color", "#28a745");
});
</script>
@endsection