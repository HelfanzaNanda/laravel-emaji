<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TasksResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function getTasks($cycleId, $toolId)
    {
        $task = Task::select('tasks.*')
        ->join('task_cycle_items', 'tasks.id', '=', 'task_cycle_items.task_id')
        ->join('cycles', 'cycles.id', 'task_cycle_items.cycle_id')
        ->where('cycles.id', $cycleId)
        ->where('tasks.tool_id', $toolId)
        ->first();
        return response()->json([
            'message' => 'successfully get tasks',
            'status' => true,
            'data' => new TasksResource($task)
        ]);
    }
}
