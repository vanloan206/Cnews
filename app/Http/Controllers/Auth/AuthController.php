<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function getLogin()
    {
    	$title = 'Login';
    	return view('auth.login', compact('title'));
    }
    public function postLogin(Request $request)
    {
    	$username = trim($request->username);
    	$password = trim($request->password);

    	if(Auth::attempt(['username' => $username, 'password' => $password])){
    		return redirect()->route('admin.news.index');
    	}else{
    		return redirect()->route('auth.login')->with('msg', 'Error username or password');
    	}
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('cnews.index.index');
    }
}
