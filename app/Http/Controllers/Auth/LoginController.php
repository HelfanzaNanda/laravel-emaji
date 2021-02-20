<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'status' => 'error',
                'message' => 'masukkan email dan password yang benar'
            ];
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        Auth::attempt($credentials);
        if (Auth::user()->isAdmin()) {
            return [
                "url" => env("APP_URL").'/user',
                'status' => 'success',
                'message' => 'berhasil Login !'
            ];
        }else {
            return [
                'status' => 'error',
                'message' => 'anda tidak mempunyai akses'
            ];
        }


    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
