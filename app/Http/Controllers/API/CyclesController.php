<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CyclesResource;
use App\Models\Cycle;
use Illuminate\Http\Request;

class CyclesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $cycles = Cycle::all();
        return response()->json([
            'message' => 'Berhasil Menampilkan cycles',
            'status' => true,
            'data' => CyclesResource::collection($cycles),
        ]);
    }
}
