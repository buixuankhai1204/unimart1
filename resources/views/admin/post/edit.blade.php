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
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{asset('admin/post/store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="post_title" id="post_title" value="{{$post->post_title}}">
                    @error('post_title')
                    <p class="help text-danger">{{$errors->first('post_title')}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="post_content" class="form-control" id="post_content" cols="30" rows="5"> value="{{!!$post->post_content!!}}</textarea>
                    @error('post_content')
                    <p class="help text-danger">{{$errors->first('post_content')}}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" name="option" id="">
                        <option value="0">Chọn danh mục</option>
                        <option value="mới nhất">MỚI NHẤT</option>
                        <option value="SẢN PHẨM MỚI">SẢN PHẨM MỚI</option>
                        <option value="ĐÁNH GIÁ">ĐÁNH GIÁ</option>
                        <option value="MẸO HAY">MẸO HAY</option>
                        <option value="THỊ TRƯỜNG">THỊ TRƯỜNG</option>
                        <option value="SỰ KIỆN">SỰ KIỆN</option>
                        <option value="STORIES">STORIES</option>
                        <option value="KHUYẾN MÃI">KHUYẾN MÃI</option>
                        <option value="LAPTOP">LAPTOP</option>
                    </select>
                    @error('category')
                    <p class="help text-danger">{{$errors->first('category')}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="chờ duyệt" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="công khai">
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection