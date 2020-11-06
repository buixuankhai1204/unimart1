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
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="text" name="keyword" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
            </div>
            <form action="{{url('/admin/user/list')}}" method="post">
            @csrf
            <div class="form-action form-inline py-3">
                <select name="option" class="form-control mr-1" id="">
                    <option>Chọn</option>
                    <option value="xóa" >xóa</option>
                    <option value="khôi phục"name="option">khôi phục</option>
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
                        <th scope="col">Họ tên</th>

                        <th scope="col">Email</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                @if($user->total()>0)
                @php
                    $t=0;
                @endphp
                @foreach($user as $item)
                @php
                    $t++;
                @endphp
                    <tr>
                        <td>
                            <input type="checkbox" value="{{$item->id}}" name="checkbox[]">
                        </td>
                        <th scope="row">{{$t}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>Admintrator</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a href="{{route('user.edit',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @if(Auth::id()!=$item->id)
                            <a href="{{route('user.delete',$item->id)}}" onclick="return confirm('bạn có chắc chắn muốn xóa thành viên này?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                 <td colspan="7"><p>không tìm thấy bản ghi nào</p></td>
                </tr>
                @endif
                
                </tbody>
            </table>
            {{$user->links()}}
        </form>           
        </div>
    </div>
</div>
@endsection