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
        $parans = $request->all();
        return User::createOrUpdate($parans);
    }

    public function delete($id)
    {
        User::destroy($id);
        return [
            "url" => url("/").'/user',
            'status' => 'success',
            'message' => 'Berhasil mengahapus data'
        ];
    }
}
