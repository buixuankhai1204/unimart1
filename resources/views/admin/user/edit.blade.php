@extends('layouts/layout')
@section('dashboard')
<link rel="stylesheet" href="">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
            <form action="{{route('user.update',$user->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control @error('name') is-danger @enderror" type="text" name="name" id="name" value="{{$user->name}}">
                    @error('name')
                    <p class="help text-danger">{{$errors->first('name')}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control @error('password') is-danger @enderror" type="text" value="{{$user->email}}" name="email" id="email">
                    @error('email')
                    <p class="help text-danger">{{$errors->first('email')}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control @error('password') is-danger @enderror" type="password" name="password" id="password">
                    @error('password')
                    <p class="help text-danger">{{$errors->first('password')}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác nhận mật khẩu</label>
                    <input class="form-control @error('password-confirm') is-danger @enderror" type="password" name="password-confirm" id="password-confirm">
                    @error('password')
                    <p class="help text-danger">{{$errors->first('password')}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="">
                        <option>Chọn quyền</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection