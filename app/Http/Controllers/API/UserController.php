<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function index()
    {
        $user_id = auth()->id();
        $user = User::where('id', $user_id)->first();
        return response()->json([
            'message' => 'successfully get current user',
            'status' => true,
            'data' => $user
        ]);
    }

    public function updateInfo(Request $request)
    {
		$user_id = auth()->id();

		$validator = Validator::make($request->all(), [
			'email' => 'required|unique:users,email,'.$user_id
		]);

		if ($validator->fails()) {
			return response()->json([
				'message' => $validator->errors(),
				'status' => false,
				'data' => (object)[]
			], Response::HTTP_UNPROCESSABLE_ENTITY);
		}

        

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
