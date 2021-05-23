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
        $taskResults = TaskResult::with(['task_result_items' => function($items){
			$items->whereDate('created_at', now()->format('Y-m-d'));
		}])->whereDate('created_at', now()->format('Y-m-d'))->get();
		$results = [];
		foreach($taskResults as $result){
			$in_array = in_array($result->tool_id, array_column($results, 'tool_id'));
			if (!$in_array) {
				array_push($results, $result);
			}
		}
		
        return response()->json([
            'message' => 'successfully store tasks',
            'status' => true,
            'data' => HistoryResource::collection(collect($results))
        ]);

    }
}
