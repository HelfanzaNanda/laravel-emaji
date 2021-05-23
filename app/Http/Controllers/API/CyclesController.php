<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CyclesResource;
use App\Models\Cycle;
use App\Models\TaskResult;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CyclesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // public function index($toolId)
    // {
    //     $taskResults = TaskResult::where('tool_id', $toolId)
	// 	->get()->pluck('cycle_id')->toArray();
    //     $cycles = Cycle::all();
    //     $results = [];
    //     foreach ($cycles as $cycle) {
    //         if (!in_array($cycle->id, $taskResults)) {
    //             array_push($results, $cycle);
    //         }
    //     }
    //     return response()->json([
    //         'message' => 'Berhasil Menampilkan cycles',
    //         'status' => true,
    //         'data' => CyclesResource::collection(collect($results)),
    //     ]);
    // }

	public function index($toolId)
    {
        $taskResults = TaskResult::where('tool_id', $toolId)->get();
        $cycles = Cycle::get()->toArray();
        $results = [];

		foreach ($taskResults as $result) {
			$key = array_search($result->cycle_id, array_column($cycles, 'id'));
			if ($key !== false) {
				if ($result->cycle_id == 1) {
					$isToday = $result->created_at->isToday();
					if ($isToday || $result->created_at == now()->format('Y-m-d')) {
						unset($cycles[$key]);
					}
				}else if ($result->cycle_id == 2) {
					$isToday = $result->created_at->addWeeks(1)->isToday();
					if ($isToday || $result->created_at == now()->format('Y-m-d')) {
						unset($cycles[$key]);
					}
				}else if ($result->cycle_id == 3) {
					$isToday = $result->created_at->addMonths(1)->isToday();
					if ($isToday || $result->created_at == now()->format('Y-m-d')) {
						unset($cycles[$key]);
					}
				}else if ($result->cycle_id == 4) {
					$isToday = $result->created_at->addMonths(6)->isToday();
					if ($isToday || $result->created_at == now()->format('Y-m-d')) {
						unset($cycles[$key]);
					}
				}else if ($result->cycle_id == 5) {
					$isToday = $result->created_at->addYears(1)->isToday();
					if ($isToday || $result->created_at == now()->format('Y-m-d')) {
						unset($cycles[$key]);
					}
				}
			}
		}
        return response()->json([
            'message' => 'Berhasil Menampilkan cycles',
            'status' => true,
            'data' => array_values($cycles)
        ]);
    }
}
