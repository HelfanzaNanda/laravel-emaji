<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        return view('file.index', [
            'files' => File::latest()->paginate(7)
        ]);
    }

    public function createOrUpdate(Request $request)
    {
        $parans = $request->all();
        return File::createOrUpdate($parans, $request);
    }

    public function delete($id)
    {
        File::destroy($id);
        return [
            "url" => env("APP_URL").'/file',
            'status' => 'success',
            'message' => 'Berhasil mengahapus data'
        ];
    }
}
