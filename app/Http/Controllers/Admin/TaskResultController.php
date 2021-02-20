<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaskResult;
use Illuminate\Http\Request;

class TaskResultController extends Controller
{
    public function index()
    {
        return view('task-result.index', [
            'taskResults' => TaskResult::latest()->paginate(7)
        ]);
    }
}
