<div class="right">
	<h2>Danh mục</h2>
	<ul>
	@foreach($arCats as $arItem)
		@php
			$id_cat = $arItem->id_cat;
			$name 	= $arItem->name;
			$slug 	= str_slug($name);
			$url 	= route('cnews.news.cat', ['slug' => $slug, 'id' => $id_cat]);
		@endphp
		<li><a href="{{ $url }}">{{ $name }}</a></li>
	@endforeach
	</ul>
</div>
