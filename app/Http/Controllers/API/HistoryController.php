<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryResource;
use App\Models\TaskResult;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $taskResults = TaskResult::with('task_result_items')->get();
        return response()->json([
            'message' => 'successfully store tasks',
            'status' => true,
            'data' => HistoryResource::collection($taskResults)
        ]);

    }
}
