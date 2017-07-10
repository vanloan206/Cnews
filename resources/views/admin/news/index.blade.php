@extends('templates.admin.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh sách tin tức</h4>
                        <br />
                        @if(Session::has('msg'))
                            <p class="alert alert-success">{{Session::get('msg')}}</p>
                        @endif
                        @if(Session::has('err'))
                            <p class="alert alert-danger">{{Session::get('err')}}</p>
                        @endif
                        
                        <a href="{{ route('admin.news.create') }}" class="alert alert-success"><img src="{{ $adminUrl }}/img/add.png" alt="" /> Thêm</a>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                                <th>ID</th>
                            	<th>Tên tin tức</th>
                            	<th>Hình ảnh</th>
                            	<th>Danh mục tin</th>
                                <th>Người đăng</th>
                            	<th>Chức năng</th>
                            </thead>
                            <tbody>
                            @foreach($objNews as $objNew)
                                @php
                                    $id     = $objNew->id_news;
                                    $name   = $objNew->name;
                                    $picture= $objNew->picture;
                                    $urlPic = Storage::url('app/files/'.$picture);
                                    $cname  = $objNew->cname;
                                    $fullname= $objNew->fullname;
                                    $editUrl= route('admin.news.edit',['id' => $id]);
                                    $delUrl = route('admin.news.del',['id' => $id]);
                                @endphp
                                <tr>
                                	<td>{{ $id }}</td>
                                	<td><a href="{{ $editUrl }}">{{ $name }}</a></td>

                                    @if($picture != '')
                                	   <td><img src="{{ $urlPic }}" alt="" width="100px" /></td>
                                    @else
                                        <td>--Chưa có hình--</td>
                                    @endif

                                    <td>{{ $cname }}</td>
                                	<td>{{ $fullname }}</td>
                                	<td>
                                		<a href="{{ $editUrl }}"><img src="{{ $adminUrl }}/img/edit.gif" alt="" /> Sửa</a> &nbsp;||&nbsp;
                                		<a href="{{ $delUrl }}"><img src="{{ $adminUrl }}/img/del.gif" alt="" /> Xóa</a>
                                	</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            <ul class="pagination">
                                {{ $objNews->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
