@extends('templates.admin.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Danh sách người dùng</h4>
                            <br />

                            @if(Session::has('msg'))
                                <p class="alert alert-success">{{ Session::get('msg') }}</p>
                            @endif 
                            @if(Session::has('err'))
                                <p class="alert alert-danger">{{ Session::get('err') }}</p>
                            @endif 

                            <a href="{{ route('admin.user.create') }}" class="alert alert-success"><img src="{{ $adminUrl }}/img/add.png" alt="" /> Thêm</a>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Username</th>
                                	<th>Fullname</th>
                                	<th>Chức năng</th>
                                </thead>
                                <tbody>
                                @foreach($objUsers as $objUser)
                                    @php
                                        $id = $objUser->id;
                                        $username   = $objUser->username;
                                        $fullname   = $objUser->fullname;
                                        $editUrl    = route('admin.user.edit', ['id' => $id]);
                                        $delUrl     = route('admin.user.del', ['id' => $id]);
                                    @endphp
                                    <tr>
                                    	<td>{{ $id }}</td>
                                        <td>{{ $username }}</td>
                                    	<td><a href="" title="">{{ $fullname }}</a></td>
                                    	<td>
                                    		<a href="{{ $editUrl }}"><img src="{{ $adminUrl }}/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                                    		<a href="{{ $delUrl }}"><img src="{{ $adminUrl }}/img/del.gif" alt="" /> Xóa</a>
                                    	</td>
                                    </tr>
                                @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
