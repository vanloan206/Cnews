<?php

namespace App\Http\Controllers\Cnews;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

class SearchController extends Controller
{
    public function search(Request $request){
    	$title = 'Tìm kiếm';
    	$search = $request->search;
        $count = 0;
    	if($search != ''){
    		$objSearch = News::where('name', 'like', "%$search%")->orWhere('preview_text', 'like', "%$search%")->get();
            $count = count($objSearch);
    		return view('cnews.search.search', compact('objSearch', 'search', 'title', 'count'));
    	}else{
    		return redirect()->route('cnews.index.index');
    	}
    }
}
