<?php

namespace App\Http\Controllers\Cnews;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\News;
use App\Cat;

class NewsController extends Controller
{
    public function cat($slug, $id)
    {
    	$objNews = News::where('id_cat', '=', $id)->orderBy('id_news', 'DESC')->paginate(getenv('ROW_COUNT'));
    	$objCat = Cat::find($id);
    	$title = $objCat->name.' - VinaEnter - Đã Học Là Làm Được';
    	return view('cnews.news.cat', compact('objNews', 'objCat', 'title'));
    }

    public function detail($slug, $id)
    {
        //tăng lượt view
        $blogKey = 'blog_'.$id;
        if(!Session::has($blogKey)){
            News::where('id_news', '=' ,$id)->increment('numread');
            Session::put($blogKey, 1);
        }
        //

    	$objNew = News::find($id);
        $reNews = News::where('id_news', '!=', $objNew->id_news)
                    ->where('id_cat', '=', $objNew->id_cat)
                    ->orderBy('id_news','DESC')
                    ->limit(2)
                    ->get(); 
        
    	$title = $objNew->name.' - VinaEnter - Đã Học Là Làm Được';
    	return view('cnews.news.detail', compact('objNew', 'title', 'reNews','blogKey'));
    }
}
