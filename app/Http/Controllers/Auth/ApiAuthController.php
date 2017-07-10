<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\User;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $username = trim($request->username);
        $password = trim($request->password);

        $obUser = User::all();
        $objUser = User::where('username', '=', $username)->where('password', '=', bcrypt($password))->get();
        if (!empty($objUser)) {
            return response()->json([
                'message' =>'successfully'
            ]);
        }else {
            return response()->json([
              'message'=>'empty'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
