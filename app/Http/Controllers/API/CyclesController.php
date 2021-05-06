<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CyclesResource;
use App\Models\Cycle;
use App\Models\TaskResult;
use Illuminate\Http\Request;

class CyclesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index($toolId)
    {

        $taskResults = TaskResult::where('tool_id', $toolId)->get()->pluck('cycle_id')->toArray();
        $cycles = Cycle::all();
        $results = [];
        foreach ($cycles as $cycle) {
            if (!in_array($cycle->id, $taskResults)) {
                array_push($results, $cycle);
            }
        }
        return response()->json([
            'message' => 'Berhasil Menampilkan cycles',
            'status' => true,
            'data' => CyclesResource::collection(collect($results)),
        ]);
    }
}
