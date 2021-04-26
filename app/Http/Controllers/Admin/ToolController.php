<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        return view('tool.index', [
            'tools' => Tool::latest()->paginate(7)
        ]);
    }

    public function createOrUpdate(Request $request)
    {
        $parans = $request->all();
        return Tool::createOrUpdate($parans, $request);
    }

    public function delete($id)
    {
        Tool::destroy($id);
        return [
            "url" => url("/").'/tool',
            'status' => 'success',
            'message' => 'Berhasil mengahapus data'
        ];
    }
}
