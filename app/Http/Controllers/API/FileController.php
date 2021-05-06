<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return response()->json([
            'message' => 'successfully store tasks',
            'status' => true,
            'data' => FileResource::collection($files)
        ]);
    }
}
