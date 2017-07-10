<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Người dùng - AdminCP - VinaEnter';
        $objUsers = User::all();
        return view('admin.user.index', compact('objUsers', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Thêm người dùng - AdminCP - VinaEnter';
        return view('admin.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $check = User::where('username', '=', $request->username)->get();
        if(count($check) > 0){
            return redirect()->route('admin.user.create')->with('msg', 'Username đã tồn tại');
        }else{
            $objUser = [
                'username' => trim($request->username),
                'password' => bcrypt(trim($request->password)),
                'fullname' => trim($request->fullname)
            ];
            if(User::insert($objUser)){
                return redirect()->route('admin.user.index')->with('msg', 'Thêm thành công');
            }else{
                return redirect()->route('admin.user.index')->with('msg', 'Lỗi khi thêm');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Sửa người dùng - AdminCP';
        $objUser = User::find($id);

        if(Auth::user()->username != 'admin' && Auth::user()->id != $objUser->id){
            return redirect()->route('admin.user.index')->with('err', 'Bạn không có quyền sửa');
        }else{
            return view('admin.user.edit', compact('objUser', 'title'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $objUser = User::find($id);
        // $objItem = Auth::User();//thông tin tài khoản đăng nhập hiện tại
        /*if($objUser->username != $objItem->username && $objUser->username != 'admin'){
            return redirect()->route('admin.user.index')->with('err', 'Bạn không thể sửa thông tin của người khác');
        }*/

        if(trim($request->password) != ''){

            $objUser->password = bcrypt(trim($request->password));
            $objUser->fullname = trim($request->fullname);
        }else{
            $objUser->fullname = trim($request->fullname);
        }
        
        if($objUser->update()){
            return redirect()->route('admin.user.index')->with('msg', 'Sửa thành công');
        }else{
            return redirect()->route('admin.user.index')->with('msg', 'Lỗi khi sửa');
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
        $objItem = Auth::User();

        if($objUser->username == 'admin' ){
            return redirect()->route('admin.user.index')->with('err', 'Bạn không thể xóa admin');
        }

        //Nếu tài khoản hiện tại đang sử dụng khác admin thì không cho xóa
        if($objItem->username != 'admin'){
            return redirect()->route('admin.user.index')->with('err', 'Bạn không có quyền xóa tài khoản');
        }

        if($objUser->delete()){
            return redirect()->route('admin.user.index')->with('msg', 'Xóa thành công');
        }else{
            return redirect()->route('admin.user.index')->with('msg', 'Lỗi khi xóa');
        }
        
    }
}
