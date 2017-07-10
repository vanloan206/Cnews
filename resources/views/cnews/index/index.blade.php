@extends('templates.cnews.master')
@section('content')
    @foreach($objNews as $objNew)
        @php
            $id_news = $objNew->id_news;
            $name    = $objNew->name;
            $slug    = str_slug($name);
            $url     = route('cnews.news.detail', ['slug' => $slug, 'id' => $id_news]);

            $picture = $objNew->picture;
            $urlPic  = Storage::url('app/files/'.$picture);
            $preview_text = $objNew->preview_text;
        @endphp
        
        <div class="item">
            <h3><a href="{{ $url }}" title="">{{ $name }}</a></h3>
            @if($picture != '')
                <img src="{{ $urlPic }}" alt="" width="585" height="340" />
            @endif
            <div class="clr"></div>
            <p>{!! $preview_text !!}</p>
        </div>
    @endforeach
    <div class="text-center">
        {{ $objNews->links() }}
    </div>
@stop        
      