<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TasksResource;
use App\Models\Cycle;
use App\Models\Task;
use App\Models\TaskResult;
use App\Models\TaskResultImages;
use App\Models\TaskResultItems;
use App\Models\Tool;
use App\Traits\uploadFileTrait;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    use uploadFileTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }   

    public function getTasks($cycleId, $toolId)
    {
        $tool = Tool::where('id', $toolId)->first();
        $cycle = Cycle::where('id', $cycleId)->first();
        $task = Task::select('tasks.*')
        ->join('task_cycle_items', 'tasks.id', '=', 'task_cycle_items.task_id')
        ->join('cycles', 'cycles.id', 'task_cycle_items.cycle_id')
        ->where('cycles.id', $cycleId)
        ->where('tasks.tool_id', $toolId)
        ->first();
        $result = [
            'cycle' => $cycle,
            'task' => $task,
            'tool' => $tool
        ];
        return response()->json([
            'message' => 'successfully get tasks',
            'status' => true,
            'data' => new TasksResource($result)
        ]);
    }

    public function store(Request $request)
    {
        try {
            $taskResult = TaskResult::create([
                'tool_id' => $request->tool_id,
                'cycle_id' => $request->cycle_id,
                'task_id' => $request->task_id,
                'user_id' => auth()->id(),
                'note' => $request->note
            ]);
    
            $tasks = $request->tasks;
            foreach ($tasks as $task) {
                TaskResultItems::create([
                    'task_result_id' => $taskResult->id,
                    'task_item_id' => $task['id'],
                    'value' => $task['answer']
                ]);
            }

            $images = $request->images;
            if ($images) {
                foreach ($images as $image) {
                    TaskResultImages::create([
                        'task_result_id' => $taskResult->id,
                        'filename' => $this->uploadImage($image)
                    ]);
                }
            }
    
            return response()->json([
                'message' => 'successfully store tasks',
                'status' => true,
                'data' => (object)[]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
                'data' => (object)[]
            ]);
        }

        
        
    }
}
