<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ToolsResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tool;

class ToolsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $tools = Tool::all();
        return response()->json([
            'message' => 'Berhasil Menampilkan Tools',
            'status' => true,
            'data' => ToolsResource::collection($tools),
        ]);
    }

    public function store(Request $request)
    {
        $rules = Validator::make($request->all(),[
            'name' => 'required',
            'merk' => 'required',
            'image' => 'file|required|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($rules->fails()) {
            return response()->json([
                'message' => $rules->errors(),
                'status' => false,
                'data' => (object)[]
            ], 400);
        }


        $image = $request->file('image');
        $filename = time(). $image->getClientOriginalExtension();
        $path=public_path('uploads/files');
        $image->move($path, $filename);

        $tool = new Tool();
        $tool->name = $request->name;
        // $tool->slug = $request->slug;
        $tool->merk = $request->merk;
        $tool->image = $filename;

        $tool->save();

        return response()->json([
            'message' => 'Berhasil Menambahkan Artikel',
            'status' => true,
            'data' => $tool
        ], 200);
    }
}
