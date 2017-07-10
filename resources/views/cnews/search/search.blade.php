@extends('templates.cnews.master')
@section('content')
    @php
        function doiMau($str, $search){
            return str_replace($search, "<span style='background:yellow;'>$search</span>", $str);
        }
    @endphp
    @foreach($objSearch as $objItem)
        @php
            $id_news = $objItem->id_news;
            $name    = strip_tags($objItem->name);
            $slug    = str_slug($name);
            $url     = route('cnews.news.detail', ['slug' => $slug, 'id' => $id_news]);

            $picture = $objItem->picture;
            $urlPic  = Storage::url('app/files/'.$picture);
            $preview_text = strip_tags($objItem->preview_text);
        @endphp
        
        <div class="item">
            <p>Có {{ $count }} kết quả cho từ khóa <span style="color: red">{{$search}}</span></p>
            <h2><a href="{{ $url }}" title="">{!!doiMau($name, $search)!!}</a></h2>
            @if($picture != '')
                <img src="{{ $urlPic }}" alt="" width="585" height="156" />
            @endif
            <div class="clr"></div>
            <p>{!!doiMau($preview_text, $search)!!}</p>
        </div>
    @endforeach
    <div class="text-center">
        {{-- {{ $objSearch->links() }} --}}
    </div>
@stop        
      