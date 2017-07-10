<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\User;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Người dùng - AdminCP';
        $objUsers = User::all();
        return response()->json(compact('title', 'objUsers'));
    }

    public function store(UserRequest $request)
    {
        $check = User::where('username', '=', $request->username)->get();
        if(count($check) > 0){
            return response()->json([
                'msg' => 'Username đã tồn tại'
            ]);
        }else{
            $objUser = [
                'username' => trim($request->username),
                'password' => bcrypt(trim($request->password)),
                'fullname' => trim($request->fullname)
            ];
            if(User::insert($objUser)){
                return response()->json([
                    'msg' => 'Thêm thành công',
                    'objUser' => $objUser
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
        $title = 'Sửa người dùng - AdminCP';
        $objUser = User::find($id);

        if(Auth::user()->username != 'admin' && Auth::user()->id != $objUser->id){
            return response()->json([
                'err' => 'Bạn không có quyền sửa'
            ]);
        }else{
            return response()->json(compact('title', 'objUser'));
        }
    }

    public function update(UserEditRequest $request, $id)
    {
        $objUser = User::find($id);
        
        if(trim($request->password) != ''){

            $objUser->password = bcrypt(trim($request->password));
            $objUser->fullname = trim($request->fullname);
        }else{
            $objUser->fullname = trim($request->fullname);
        }
        
        if($objUser->update()){
            return response()->json([
                'msg' => 'Sửa thành công'
            ]);
        }else{
            return response()->json([
                'msg' => 'Lỗi khi sửa'
            ]);
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
        $objUser = User::find($id);

        if($objUser->username == 'admin' ){
            return response()->json([
                'msg' => 'Không thể xóa admin'
            ]);
        }

        if($objUser->delete()){
            return response()->json([
                'msg' => 'Xóa thành công'
            ]);
        }else{
            return response()->json([
                'msg' => 'Lỗi khi xóa'
            ]);
        }
        
    }
}
