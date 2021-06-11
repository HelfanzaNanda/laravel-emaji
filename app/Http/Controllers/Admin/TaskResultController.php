<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaskResult;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;

class TaskResultController extends Controller
{
    public function index()
    {
		$date = Carbon::now()->format('d-m-Y');
        return view('task-result.index', [
            'taskResults' => TaskResult::latest()->paginate(7),
			'date' => $date
        ]);
    }

	public function filter(Request $request)
	{
		$date = Carbon::parse($request->filter_date)->format('Y-m-d');
		return view('task-result.index', [
            'taskResults' => TaskResult::whereDate('created_at', $date)->latest()->paginate(7),
			'date' => $request->filter_date
        ]);
	}

	public function detail($id)
	{
		$result = TaskResult::whereId($id)->with('task_result_items', 'task_result_images')->first();
		return view('task-result.detail', [
			'result' => $result
		]);
	}

	public function pdf($id)
	{
		$result = TaskResult::whereId($id)->with('task_result_items', 'task_result_images')->first();
		// return view('task-result.pdf', [
		// 	'result' => $result
		// ]);
		$pdf = PDF::loadView('task-result.pdf', [
			'result' => $result
		]);
		return $pdf->download('hasil.pdf');
	}
}
