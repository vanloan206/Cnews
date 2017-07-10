@extends('templates.admin.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Sửa danh mục</h4>
                        </div>
                        <div class="content">
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
                            <form action="{{ route('admin.cat.edit',['id' => $objCat->id_cat]) }}" method="post">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tên danh mục</label>
                                            <input type="text" name="name" class="form-control border-input" value="{{ $objCat->name }}">
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