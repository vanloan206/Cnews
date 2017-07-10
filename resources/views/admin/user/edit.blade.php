@extends('templates.admin.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Sửa thông tin người dùng</h4>
                        </div>
                        <div class="content">
                        	@if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.user.edit',['id' => $objUser->id]) }}" method="post">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control border-input" value="{{ $objUser->username }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control border-input" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input type="text" name="fullname" class="form-control border-input" value="{{ $objUser->fullname }}">
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