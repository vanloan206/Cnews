@extends('templates.admin.master')
@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Sửa tin tức</h4>
                        </div>
                        <div class="content">
                            @php
                                $id_news        = $objNew->id_news;
                                $name           = $objNew->name;
                                $numread        = $objNew->numread;
                                $picture        = $objNew->picture;
                                $urlPic         = Storage::url('app/files/'.$picture);
                                $id_cat         = $objNew->id_cat;
                                $preview_text   = $objNew->preview_text;
                                $detail_text    = $objNew->detail_text;
                            @endphp
                            @if(Session::has('msg'))
                                <p class="alert alert-danger">{{ Session::get('msg') }}</p>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <label>Tên tin tức</label>
                                            <input type="text" name="name" class="form-control border-input" placeholder="Tên tin tức" value="{{ $name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="read">Lượt đọc</label>
                                            <input type="text" name="read" value="{{ $numread }}" class="form-control border-input" placeholder="Lượt đọc">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Danh mục tin</label>
                                            <select name="id_cat" class="form-control border-input">
                                            @foreach($objCats as $key => $objCat)
                                                @php 
                                                    $id_cat = $objCat->id_cat;
                                                    $name= $objCat->name;
                                                    if($objCat->id_cat == $objNew->id_cat){
                                                        $selected = 'selected = "selected"';

                                                    }else{
                                                        $selected = "";
                                                    }
                                                @endphp
                                                <option {{ $selected }} value="{{ $id_cat }}">{{ $name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hình ảnh</label>
                                            <input type="file" name="picture" class="form-control" placeholder="Chọn ảnh" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        @if($picture != '')
                                            <label>Ảnh cũ</label>
                                            <img src="{{ $urlPic }}" width="120px" alt="" /> Xóa <input type="checkbox" name="delete_picture" value="{{ $id_news }}" />
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea rows="4" name="preview_text" class="form-control border-input" placeholder="Mô tả tóm tắt về tin tức">{{ $preview_text }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Chi tiết</label>
                                            <textarea rows="6" id="editor1" name="detail_text" class="form-control border-input" placeholder="Mô tả chi tiết về tin tức">{{ $detail_text }}</textarea>
                                            <script type="text/javascript">
                                                CKEDITOR.replace( 'editor1', {
                                                    filebrowserBrowseUrl: '{{ $adminUrl }}/js/ckfinder/ckfinder.html',
                                                    filebrowserImageBrowseUrl: '{{ $adminUrl }}/js/ckfinder/ckfinder.html?type=Images',
                                                    filebrowserFlashBrowseUrl: '{{ $adminUrl }}/js/ckfinder/ckfinder.html?type=Flash',
                                                    filebrowserUploadUrl: '{{ $adminUrl }}/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                    filebrowserImageUploadUrl: '{{ $adminUrl }}/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                    filebrowserFlashUploadUrl: '{{ $adminUrl }}/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                                } );
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    <input type="submit" class="btn btn-info btn-fill btn-wd" value="Thực hiện" />
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop