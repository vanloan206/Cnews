<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CatRequest;
use App\Cat;
use App\News;

class CatController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title    = 'Danh mục tin - AdminCP - VinaEnter';
    	$objCats  = Cat::all();
    	return view('admin.cat.index', compact('objCats', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Thêm danh mục tin - AdminCP - VinaEnter';
    	return view('admin.cat.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatRequest $request) 
    {
    	$check = Cat::where('name', '=', $request->name)->get();
    	if(count($check) > 0){
    		return redirect()->route('admin.cat.create')->with('msg', 'Tên danh mục đã tồn tại');
    	}else{
    		$objCat = [
	    		'name' => trim($request->name)
	    	];
	    	if(Cat::insert($objCat)){
                return redirect()->route('admin.cat.index')->with('msg', 'Thêm thành công');
            }else{
                return redirect()->route('admin.cat.index')->with('msg', 'Lỗi khi thêm');
            }
    	}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $title = 'Sửa danh mục tin - AdminCP - VinaEnter';
    	$objCat = Cat::find($id);
    	return view('admin.cat.edit', compact('objCat', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatRequest $request, $id) 
    {
    	$objCat = Cat::find($id);

    	//Kiểm tra điều kiện khác id && trùng tên
    	$check = Cat::where('name', '=', trim($request->name), 'and', 'id_cat', '!=', $id)->get();
    	if(count($check) > 0){
    		return redirect()->route('admin.cat.edit', compact('id', 'objCat'))->with('msg', 'Tên danh mục đã tồn tại');
    	}else{ //Nếu danh mục chưa có
    		
			$objCat->name = trim($request->name);

	    	if($objCat->update()){
                return redirect()->route('admin.cat.index')->with('msg', 'Sửa thành công');
            }else{
                return redirect()->route('admin.cat.index')->with('msg', 'Lỗi khi sửa');
            }
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
    	$objCat = Cat::findOrFail($id);
        $objNews = News::where('id_cat', '=', $id)->get();

        foreach ($objNews as $objNew) {
            $picture = $objNew->picture;
            if($picture != ''){
                Storage::delete('files/'.$picture);
            }
            $objNew->delete();
        }

    	if($objCat->delete()){
            return redirect()->route('admin.cat.index')->with('msg', 'Xóa thành công');
        }else{
            return redirect()->route('admin.cat.index')->with('msg', 'Lỗi khi xóa');
        }
    }
}
