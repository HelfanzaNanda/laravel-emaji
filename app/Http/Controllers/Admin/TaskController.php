<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Cycle, Task, Tool};
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('task.index', [
            'tasks' => Task::latest()->paginate(7)
        ]);
    }

    public function create()
    {
        return view('task.create', [
            'tools' => Tool::all(),
            'cycles' => Cycle::all(),
        ]);
    }

    public function createOrUpdate(Request $request)
    {
        $parans = $request->all();
        //return $parans;
        return Task::createOrUpdate($parans, $request);
    }

    public function delete($taskId)
    {
        $task = Task::whereId($taskId)->first();
        $task->taskItems()->delete();
        $task->taskCycleItems()->delete();
        $task->delete();
        return [
            'url' => url("/")."/tool",
            'status' => 'success',
            'message' => 'Berhasil mengahapus data'
        ];
    }

    public function detail($toolId)
    {
        return view('task.detail', [
            'tool' => Tool::whereId($toolId)->first()
        ]);
    }
}
