<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        //Validasi Form
        $rules = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'min:6|required'
        ]);

        if ($rules->fails()) {
            return response()->json([
                'message' => $rules->errors(),
                'status' => false,
                'data'   => (object)[]
            ]);
        }


        //Validasi Pada Database
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credential)) {
            $user = Auth::user();
            return response()->json([
                'message' => 'Berhasil Login',
                'status' => true,
                'data' => $user,
            ], 200);
        }

        return response()->json([
            'message' => 'Masukkan Email dan Password yang benar',
            'status' => false,
            'data' => (object)[]
        ], 201);
    }
}
