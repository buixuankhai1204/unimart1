@extends('layouts/layout')

@section('dashboard')

<head>
    <script src="https://cdn.tiny.cloud/1/5qentfy4voz4qvxapreh6g12h7cgqi3v1arlezyrflsnem4j/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        var editor_config = {
            path_absolute: "http://localhost/unimart/",
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback: function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
</head>
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="{{asset('admin/product/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm</label>
                            <input class="form-control @error('product_name') is-danger @enderror" type="text" name="product_name" id="product_name">
                            @error('product_name')
                            <p class="help text-danger">{{$errors->first('product_name')}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_price">Giá</label>
                            <input class="form-control @error('product_price') is-danger @enderror" type="text" name="product_price" id="product_price">
                            @error('product_price')
                            <p class="help text-danger">{{$errors->first('product_price')}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="intro">Cấu hình sản phẩm</label>
                            <textarea name="product_configuration" class="form-control @error('product_configuration') is-danger @enderror" id="intro" cols="30" rows="5"></textarea>
                            @error('product_configuration')
                            <p class="help text-danger">{{$errors->first('product_configuration')}}</p>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    <textarea name="product_content" class="form-control @error('product_content') is-danger @enderror" id="intro" cols="30" rows="5"></textarea>
                    @error('product_content')
                    <p class="help text-danger">{{$errors->first('product_content')}}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control " name="option" id="" name="category">
                        <ul>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            <ul>
                                @foreach ($category->childrenCategories as $childCategory)
                                <option value="{{$childCategory->id}}">--@include('child_category', ['child_category' => $childCategory])</option>
                                @endforeach
                            </ul>
                            @endforeach
                        </ul>

                    </select>
                    <!-- <select class="form-control " name="option" id="" name="category">
                        <option >Chọn danh mục</option>
                        <option value="Điện thoại">điện thoại</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Máy tính">Máy tính</option>
                    </select> -->
                    @error('category')
                    <p class="help text-danger">{{$errors->first('category')}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Chờ duyệt" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Công khai">
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    
                        <input type="file" class="form-control-file"   >
                        <label class="custom-file-label">Choose file</label>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection