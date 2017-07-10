<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CatRequest;
use App\Cat;
use App\News;

class ApiCatController extends Controller
{
    public function index()
    {
        $title    = 'Danh mục tin - AdminCP';
    	$objCats  = Cat::all();
    	return response()->json([
            'title'     => $title,
            'objCat'    => $objCats
        ]);
    }

    public function store(CatRequest $request) 
    {
        $check = Cat::where('name', '=', $request->name)->get();
        if(count($check) > 0){
            return response()->json([
                'msg' => 'Tên danh mục đã tồn tại'
            ]);
        }else{
            $objCat = [
                'name' => trim($request->name)
            ];
            if(Cat::insert($objCat)){
                return response()->json([
                    'msg' => 'Thêm thành công',
                    'objCat' => $objCat
                ]);
            }else{
                return response()->json([
                    'msg' => 'Lỗi khi thêm'
                ]);
            }
        }
    }
    
    public function edit($id) 
    {
        $title    = 'Sửa danh mục tin - AdminCP';
    	$objCat = Cat::find($id);
    	return response()->json([
            'title'     => $title,
            'objCat'=> $objCat
        ]);
    }

    public function update(CatRequest $request, $id) 
    {
    	$objCat = Cat::find($id);

    	//Kiểm tra điều kiện khác id && trùng tên
    	$check = Cat::where('name', '=', trim($request->name), 'and', 'id_cat', '!=', $id)->get();
    	if(count($check) > 0){
            return response()->json([
                'msg' => 'Tên danh mục đã tồn tại',
                'id'  => $objCat->id_cat,
                'objCat' => $objCat
            ]);
    	}else{ //Nếu danh mục chưa có
    		
			$objCat->name = trim($request->name);

	    	if($objCat->update()){
                return response()->json([
                    'msg' => 'Sửa thành công',
                    'objCat' => $objCat
                ]);
            }else{
                return response()->json([
                    'msg' => 'Lỗi khi sửa'
                ]);
            }
    	}
    }

    
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
            return 'Xóa thành công';
        }else{
            return 'Lỗi khi xóa';
        }
    }
}
