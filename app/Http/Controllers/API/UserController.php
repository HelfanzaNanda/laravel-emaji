<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function updateInfo(Request $request)
    {
        $user_id = auth()->id();

        $user = User::where('id', $user_id)->first();
        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
        ]);

        return response()->json([
            'message' => 'successfully update info',
            'status' => true,
            'data' => (object)[]
        ]); 
    }

    public function updatePassword(Request $request)
    {
        $user_id = auth()->id();
        $user = User::where('id', $user_id)->first();
        $user->update([
            'password' => $request->password ?? $user->password,
        ]);

        return response()->json([
            'message' => 'successfully update password',
            'status' => true,
            'data' => (object)[]
        ]); 
    }
}
