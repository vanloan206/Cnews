@extends('templates.cnews.master')
@section('content')
@php
	$name = $objNew->name;
	$read = $objNew->numread;
	$detail_text = $objNew->detail_text;
	$picture  = $objNew->picture;
    $urlPic   = Storage::url('app/files/'.$picture);
    
@endphp
<p id="name">{{ $name }}</p>
<p id="read">Lượt xem: {{ $read }}</p>
<div class="item-detail">
	@if($picture != '')
	  	<img src="{{ $urlPic }}" alt="" width="590" title="{{ $name }}" />
	@endif
    <p>{!! $detail_text !!}</p>
</div>
<div id="re-news">
<h3>Tin tức liên quan</h3>
@foreach($reNews as $reNew)
@php
	$id  		= $reNew->id_news;
	$hinhanh  	= $reNew->picture;
    $url   		= Storage::url('app/files/'.$hinhanh);
    $rename		= $reNew->name;
    $slug		= str_slug($rename);
    $repreview	= $reNew->preview_text;
    $value 		= str_limit($repreview, 170);
    $urlDetail 	= route('cnews.news.detail', ['slug' => $slug,'id' => $id]);
@endphp
<div class="reNew">
	<div id="frame-img" title="{{ $rename }}">
		@if($hinhanh != '')
	  	<img src="{{ $url }}" alt="" width="100" height="100"  />
	@endif
	</div>

	<div id="frame-p">
		<a href="{{ $urlDetail }}" title="{{ $rename }}">{{ $rename }}</a>
		<p>{!! $value !!}</p>
	</div>
	
</div>
<div class="clr"></div>
@endforeach
</div>
@stop

      

      
