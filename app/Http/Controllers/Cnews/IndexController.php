<?php

namespace App\Http\Controllers\Cnews;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

class IndexController extends Controller
{
    public function index()
    {
    	$title = 'VinaEnter - Đã Học Là Làm Được';
    	$objNews = News::orderBy('id_news', 'DESC')->paginate(getenv('ROW_COUNT'));
    	return view('cnews.index.index', compact('objNews', 'title'));
    }
}
