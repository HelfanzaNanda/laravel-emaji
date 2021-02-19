<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'users' => User::where('role' , '!=', 'admin')->latest()->paginate(7)
        ]);
    }

    

    public function createOrUpdate(Request $request)
    {
        $validator = User::validateForm($request->all());
        if ($validator->fails()) {
            return [
                'status' => '422',
                'message' => $validator->getMessageBag()
            ];
        }

        if ($request->id) {
            $user = User::whereId($request->id)->first();
            $user->update([
                'name' => $request->name ?? $user->name,
                'role' => $request->role ?? $user->role,
                'email' => $request->email ?? $user->email,
            ]);

            return [
                'status' => 'success',
                'message' => 'berhasil mengubah data !'
            ];
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make('12345678')
        ]);

        return [
            'status' => 'success',
            'message' => 'berhasil menambahkan data !'
        ];
    }

    public function delete($id)
    {
        User::destroy($id);
        return [
            'status' => 'success',
            'message' => 'Berhasil mengahapus data'
        ];
    }
}
