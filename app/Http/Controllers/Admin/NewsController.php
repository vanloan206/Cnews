<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\Auth;
use App\News;
use App\Cat;
use App\User;

class NewsController extends Controller
{
    public function index()
    {
        $title    = 'Tin tức - AdminCP - VinaEnter';
    	$objNews  = News::getList();
    	return view('admin.news.index', compact('objNews', 'title'));
    }

    public function create()
    {
        $title   = 'Thêm tin tức - AdminCP - VinaEnter';
    	$objCats = Cat::all();
    	return view('admin.news.create', compact('objCats', 'title'));
    }

    public function store(NewsRequest $request)
    {
    	$objNews   = new News();

    	$objNews->name         = $request->name;
        $objNews->numread      = 0;
    	$objNews->preview_text = $request->preview_text;
    	$objNews->detail_text  = $request->detail_text;
    	$objNews->id_cat       = $request->id_cat;
        $objNews->id_user      = Auth::user()->id;

    	//Kiểm tra upload hình
    	$picture = '';
    	if($request->hasFile('picture')) {
    		$path     = $request->file('picture')->store('files');
    		$tmp      = explode('/', $path);
    		$picture  = end($tmp);
    	}
        $objNews->picture = $picture;

    	if($objNews->save()){
    		return redirect()->route('admin.news.index')->with('msg', 'Thêm thành công');
    	}else{
    		return redirect()->route('admin.news.index')->with('msg', 'Lỗi khi thêm');
    	}
    }

    public function edit($id)
    {
        //lấy trang hiện tại
        $news       = News::where('id_news', '>=', $id)->get();
        $countNews  = count($news);
        $page       = ceil($countNews/getenv('ROW_COUNT'));

        $title      = 'Sửa tin tức - AdminCP - VinaEnter';
        $objCats    = Cat::all();
        $objNew     = News::find($id);

        //Kiểm tra bài đăng của người dùng
        $objItem    = Auth::user();
        if($objItem->username != 'admin' && $objItem->id != $objNew->id_user){
            return redirect()->route('admin.news.index', compact('page'))->with('err', 'Bạn không có quyền sửa tin này!');
        }else{
            return view('admin.news.edit', compact('objNew', 'objCats', 'title'));
        }
        
    }

    public function update(NewsRequest $request,$id)
    {
        $news       = News::where('id_news', '>=', $id)->get();
        $countNews  = count($news);
        $page       = ceil($countNews/getenv('ROW_COUNT'));

        $objNew     = News::find($id);
        $picture    = $objNew->picture;

        $objNew->name         = trim($request->name);
        $objNew->preview_text = trim($request->preview_text);
        $objNew->detail_text  = trim($request->detail_text);
        $objNew->id_cat       = trim($request->id_cat);
        $objNew->id_user      = $objNew->id_user;

        //xử lý ảnh
        if($request->picture != ''){
            $tenanhcu   = $objNew->picture;
            //up anh moi
            $path       = $request->picture->store('files');
            $tmp        = explode('/',$path);
            $tenanhmoi  = end($tmp);

            //xoa anh cu
            $pathOldPic = storage_path('app/files/'.$tenanhcu);
            if(is_file($pathOldPic) && ($tenanhcu != "")){
                Storage::delete('files/'.$tenanhcu);
            }
            $objNew->picture = $tenanhmoi;

        }else{
            //xoa anh neu checkbox dc chon
            if($request->input('delete_picture'))
            {
                $tenanhcu = $objNew->picture;
                Storage::delete('files/'.$tenanhcu);
                $objNew->picture = '';
            }else{
                $objNew->picture = $picture;
            }
        }
        
        if($objNew->update()){
            return redirect()->route('admin.news.index', compact('page'))->with('msg', 'Sửa thành công');
        }else{
            return redirect()->route('admin.news.index', compact('page'))->with('msg', 'Lỗi khi sửa');
        }
    }

    public function destroy($id)
    {
        //lấy trang hiện tại
        $news       = News::where('id_news', '>=', $id)->get();
        $countNews  = count($news);
        $page       = ceil($countNews/getenv('ROW_COUNT'));

        $objNew     = News::find($id);
        $objItem    = Auth::user();

        //Kiểm tra bài đăng của người dùng
        if($objItem->username != 'admin' && $objItem->id != $objNew->id_user){
            return redirect()->route('admin.news.index', compact('page'))->with('err', 'Bạn không có quyền xóa bài viết này!!!');
        }else{
            //xóa hình
            $picture    = $objNew->picture;
            $pathOldPic = storage_path('app/files/'.$picture);

            if(is_file($pathOldPic) && ($picture != "")){
                Storage::delete('files/'.$picture);
            }
            //xóa tin
            if($objNew->delete()){
                return redirect()->route('admin.news.index', compact('page'))->with('msg', 'Xóa thành công');
            }else{
                return redirect()->route('admin.news.index', compact('page'))->with('msg', 'Lỗi khi xóa');
            }
        }
    }

}
