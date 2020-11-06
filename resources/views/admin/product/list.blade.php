@extends('layouts/layout')
@section('dashboard')
<div id="content" class="container-fluid">
    <div class="card">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="text" name="keyword" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{route('product.status_1')}}" class="text-primary">Trạng thái 1<span class="text-muted">({{$product_order_1->count()}})</span></a>
                <a href="{{route('product.status_2')}}" class="text-primary">Trạng thái 2<span class="text-muted">({{$product_order_2->count()}})</span></a>
                <a href="{{route('product.status_3')}}" class="text-primary">Trạng thái 3<span class="text-muted">({{$product_order_3->count()}})</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <form action="{{url('/admin/product/list')}}" method="POST">
                @csrf
                    <select  name="option" class="form-control mr-1" id="">
                        <option>Chọn</option>
                        <option value="còn hàng">còn hàng</option>
                        <option value="hết hàng">hết hàng</option>
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>

            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if($product->total()>0)
                    @php
                    $t=0;
                    @endphp
                    @foreach($product as $item)
                    @php
                    $t++;
                    @endphp
                    <tr class="">
                        <td>
                            <input type="checkbox" value="{{$item->id}}" name="checkbox[]">
                        </td>
                        <td>{{$t}}</td>
                        <td><img src="http://via.placeholder.com/80X80" alt=""></td>
                        <td><a href="#">{{$item->product_name}}</a></td>
                        <td>{{$item->product_price}}</td>
                        <td>{{$item->category}}</td>
                        <td>{{$item->date_create}}</td>
                        <td><span class="badge badge-success">{{$item->status}}</span></td>
                        <td>
                            <a href="{{route('product.edit',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('product.delete',$item->id)}}" onclick="return confirm('bạn có chắc chắn muốn xóa sản phẩm này?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7">
                            <p>không tìm thấy bản ghi nào</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {{$product->links()}}
        </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function(){
  $(".badge-success:contains(còn hàng)").css("background-color", "#28a745");
  $(".badge-success:contains(hết hàng)").css("background-color", "#c82333");
});
</script>
@endsection
