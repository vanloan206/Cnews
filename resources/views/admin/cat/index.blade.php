@extends('templates.admin.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Danh sách danh mục</h4>
                            <br />
                            
                            @if(Session::has('msg'))
                                <p class="alert alert-success">{{ Session::get('msg') }}</p>
                            @endif 

                            <a href="{{ route('admin.cat.create') }}" class="alert alert-success"><img src="{{ $adminUrl }}/img/add.png" alt="" /> Thêm</a>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-striped">
                                <thead>
                                    <th>ID</th>
                                	<th>Tên danh mục</th>
                                	<th>Chức năng</th>
                                </thead>
                                <tbody>
                                @foreach($objCats as $objCat)
                                    @php
                                        $id     = $objCat->id_cat;
                                        $name   = $objCat->name;
                                        $editUrl= route('admin.cat.edit', ['id' => $id]);
                                        $delUrl = route('admin.cat.del', ['id' => $id]);
                                    @endphp
                                    <tr>
                                    	<td>{{ $id }}</td>
                                    	<td><a href="{{ $editUrl }}">{{ $name }}</a></td>
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
